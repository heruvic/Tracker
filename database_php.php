<?php

$username="root";
$password="";
$database="organization";

mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database");

$query = sprintf("SELECT * FROM trade");
$result=mysql_query($query) or die("Error!");

$num=mysql_numrows($result);


$returnAll = array();

//'{"params": ["category", "count"]}'

$returnAll['num'] = $num;

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

/*
$js = '{params: ["a", "b", ]}';
$json = '{"a":"apples","b":["bananas","boysenberries"],"c":"carrots"}';
$arr = json_decode($json);
echo $arr->a; 
echo $arr->b[0]; 
*/

/*
$joe = array();
$joe['james'] = 3;
echo json_encode($joe);
*/

mysql_close();
echo 'it worked...';
?>