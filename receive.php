<?php

#################################
# Waschi Waschmaschinenverbund  #
# Version: 0.6-0003             #
# (c) 2013 by MeikoDis          #
# License: GNU-AGPL v3          #
#################################


	include("key.php");
	include("filter.php");



	setlocale(LC_ALL, 'de_DE.utf8');
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		if($key1!=$_POST['key1'] || $key2!=$_POST['key2']) die("Your keys are incorrect!");
		if(in_filter($_POST['object'])==true) die("Filtered!");

		if($key1==$_POST['key1'] && $key2==$_POST['key2'] && $_POST['object']!="" ){
			$obj = escapeshellcmd($_POST['object'])."\n";

			
			$fh = fopen("./found", 'a') or die("can't open file");
			fwrite($fh, $obj);
			fclose($fh);


#			shell_exec("LANG=de_DE.utf8; echo ".$obj." >> found");
		}

	}
?>
