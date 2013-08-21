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

  setlocale(LC_ALL, 'de_DE.utf8');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if( $_POST['user'] != "" &&
        $_POST['pwd'] != ""){

      if(!file_exists("./users.php")) {
        $fu = fopen("./users.php", 'a') or die ("can't open file");
        fwrite($fu, "<?php\n");
        fclose($fu);
      }
      if(!file_exists("./pwds.php")) {
        $fu = fopen("./pwds.php", 'a') or die ("can't open file");
        fwrite($fu, "<?php\n");
        fclose($fu);
      }

      $usr = escapeshellcmd($_POST['user'])."\n";
      $pwd = escapeshellcmd($_POST['pwd'])."\n";

      if($_POST['action']=='put'){
      
        if($key1!=$_POST['key1'] || $key2!=$_POST['key2']) die("Your keys are incorrect!");

        $fu = fopen("./users.php", 'a') or die("can't open file");
        fwrite($fu, $usr);
        fclose($fu);
        
        $fp = fopen("./pwds.php", 'a') or die("can't open file");
        fwrite($fp, $pwd);
        fclose($fp);

        echo("Written $usr successfully!");
      }

      if($_POST['action']=='look'){
        $wash = 0;
        $fu = file("users.php");
        $fp = file("pwds.php");

        for($i = 1; $i < sizeof($fu); $i++){
          if( 0 == strcmp($fu[$i], $usr) &&
            0 == strcmp($fp[$i], $pwd)){
            $wash++;
          }
        }
        echo("$wash");
      }
    }
    if($_POST['action']=="list"){
      $fu = file("users.php");
      $fp = file("pwds.php");
      $users = array();

      for($i = 1; $i < sizeof($fu); $i++){
        if($i > 15){
          break;
        }
        $user = $fu[$i];
        $pwd = $fp[$i];

        if(array_key_exists($user, $users)){
          if($users[$user]['pwd'] == $pwd){
            $users[$user]['score']++;
          }
        }else{
          $users[$user]=array();
          $users[$user]['name'] = trim($user);
          $users[$user]['pwd'] = $pwd;
          $users[$user]['score'] = 1;
        }
      }
      usort($users, "cmp");
      foreach($users as $user){
        echo($user['name']." ".$user['score']."\n");
      }
    }
  }

  function cmp($a, $b){
    $ascr = $a['score'];
    $bscr = $b['score'];
    
    if($ascr == $bscr){
      return 0;
    }
    return ($ascr > $bscr) ? -1 : 1;
  }
?>
