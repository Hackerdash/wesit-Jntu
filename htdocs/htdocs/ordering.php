<?php

error_reporting(E_PARSE);
include("connection.php");
$testid="WD09/18_1015";
$buttoncolor="blue";
$alldatasql="select * from exam_question where test_id='$testid' order by RAND()";
$alldataresult=mysql_query($alldatasql);
$alldataresult2=mysql_query($alldatasql);
$i=1;
$quesorder=array();
while($alldata=mysql_fetch_array($alldataresult))
{
	$quesorder[$i]=$alldata[2];
	$i++;
	
}

?>