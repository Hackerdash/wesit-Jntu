<?php
session_start();
if(!isset($_SESSION['loginrollno']))
{
	header("location:index.php");
}
else
{
	include("connection.php");
	
	$testid=$_SESSION['tid'];
	$somesql="select * from exam_question where test_id='$testid' order by RAND()";
	$sqlresult=mysql_query($somesql);
	var_dump($sqlresult);
	$i=1;
	while($sqldata=mysql_fetch_array($sqlresult))
{
	$_SESSION[$i]=$sqldata;
	var_dump($_SESSION[$i]);
	echo "<br/><br/>";
}

}
?>