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

$remote_highscore = "http://waschi.org/highscore.php";

function take_away($object, $user, $pwd, $ff, $uf, $pf, $status='', $answer=FALSE) {
  # Change here if you want a different one:
  if(!in_filter($object) && !in_filter($user)){
    for($i = 0; $i < sizeof($ff); $i++){
      if( 0 == strcmp($ff[$i], $object."\n") && //Just a simple stringcompare to check input.
          0 == strcmp($uf[$i+1], $user."\n") &&
          0 == strcmp($pf[$i+1], $pwd."\n")){
            $data=array("key1" => $key1, "key2" => $key2, "action" => "put", "user" => $user, "pwd" => $pwd);
            post_request($remote_highscore, $data);

            $look_data=array("key1" => $key1, "key2" => $key2, "action" => "look", "user" => $user, "pwd" => $pwd);
            $score=post_request($remote_highscore, $look_data);

            $status="Hier ist dein ".$object.", ".$user.". Anzahl der erfolgreichen Mitnahmen von dir:".$score['content'].".";
            $answer = TRUE;

            //Removing the object from the lists
            $ff[$i] = '';      
            $ff = array_filter($ff);
            file_put_contents("found",implode($ff));
                    
            $uf[$i+1] = '';  
            $uf = array_filter($uf);
            file_put_contents("users.php",implode($uf));
                    
            $pf[$i+1] = '';
            $pf = array_filter($pf);
            file_put_contents("pwds.php",implode($pf));
                  
            break;
            }}

    if ($answer != TRUE){
      $status = "Falsche angaben!";}
    else{
      $answer = FALSE;}
         
  }else{
	  $status="Also DAS(".$object.") ist nicht gültig, ".$user.".";
			}
  return $status;}
?> 
