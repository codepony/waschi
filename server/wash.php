<?php


#    Waschi Waschmaschinenverbund
#    Copyright (C) 2013  MeikoDis
#
#    This program is free software: you can redistribute it and/or modify
#    it under the terms of the GNU Affero General Public License as published by
#    the Free Software Foundation, either version 3 of the License, or
#    (at your option) any later version.
#
#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
#    Contact:
#    Identi.ca or Twitter:  @MeikoDis
#    Email or Jabber:       meikodis@meikodis.org


include("key.php");
include("filter.php");
include("post.php");
include("giveaway.php");

$ff = file("found");
$uf = file("users.php");
$pf = file("pwds.php");

$remoteserver=explode("\n",file_get_contents("http://waschi.org/servers.php"));

$remote_highscore = "http://waschi.org/highscore.php";

function get_random_word(){
  $rand_word=html_entity_decode(file_get_contents("http://dev.revengeday.de/pointlesswords/api/"), ENT_COMPAT, "UTF-8");
  if(!in_filter($rand_word)) {
    return $rand_word;
  } else {
    return get_random_word();
  }
}

if(!count($remoteserver)<=1){

	if($_SERVER['REQUEST_METHOD'] == "POST") {

		if(!stristr($remoteserver[0], "ERROR")){

			$object=$_POST["Kleidung"];
      $user=$_POST["Username"];      
      $pwd=sha1(md5(sha1($_POST["Password"]))); //Just in case, someone wants to bruteforce.
      
      if(isset($_POST["RandomWord"]) && $_POST["RandomWord"] == True){
        $object=get_random_word();
      }

      if(isset($_POST["Score"]) && $_POST["Score"] == True){
        $data = array("action" => "look", "user" => $user, "pwd" => $pwd);
        $score = post_request($remote_highscore, $data);
        $status = $score["content"];
      } elseif(isset($_POST["TakeAway"]) && $_POST["TakeAway"] == True){
        $status = take_away($object, $user, $pwd, $ff, $uf, $pf, $remote_highscore);
      } else {
    		if(!in_filter($object) && !in_filter($user)){

		  		if( $odd = rand(1,2)%2 ) { 

			  		$data=array("key1" => $key1, "key2" => $key2, "object" => $object, "user" => $user, "pwd" => $pwd);

				  	$arrayrand = array_rand($remoteserver);
				  	while(strstr($remoteserver[$arrayrand], $_SERVER['SERVER_NAME']) || $remoteserver[$arrayrand] == "" ){

					  	$arrayrand = array_rand($remoteserver);
				  	}
				  	$rs=$remoteserver[$arrayrand];
				  	post_request($rs, $data);
				  	$status="Deine W&auml;sche ".$user." (".$object.") ... SIE IST WEG!";
			  	}else{
				  	$status="Hier ist dein/e ".$object."! Alles fein sauber, ".$user."! :)";
			  	}
		  	}else{
			  	$status="Also DAS(".$object.") kann ich nicht waschen, ".$user.".";
			  }}

		}else $status="R&uuml;ste deine Waschmaschine erst einmal auf.";

	}

}else $status="Der Stecker ist grad ein bisschen kaputt. :(";

?> 
