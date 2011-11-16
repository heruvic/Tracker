<?php

    header('Access-Control-Allow-Origin: *');
    /* Database connection */
	$username="root";
	$password="";
	$database="organization";
	mysql_connect('localhost',$username,$password);
	@mysql_select_db($database) or die( "Unable to select database");

	$query = sprintf("SELECT * FROM %s", $_GET['table']);
	$result=mysql_query($query) or die("Error!");

	$num=mysql_numrows($result);
	$returnAll = array();
	$returnAll['num'] = $num;

	//'{"params": ["category", "count"]}'

	$i=0;
	while ($i < $num) {
		$extraVar = json_decode( $_GET['extraArgs']);
		$newRow = array();
		foreach ($extraVar->params as $value) {	  
			$newRow[$value] = mysql_result($result, $i, $value);
		}
	
		$returnAll[$i] = $newRow;
		$i++;
	}

	echo json_encode($returnAll);

	mysql_close();
?>