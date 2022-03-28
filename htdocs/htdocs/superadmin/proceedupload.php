<?php
//proceed uplaoding of questions
session_start();
error_reporting(1);
include 'db.php';
$testid=$_GET['testid'];
$sql="select * from exam_quescache where test_id='$testid'";
$res=mysql_query($sql);

while($data=mysql_fetch_row($res))
{
	$qno=(int)$data[2];
	$p=(float)$data[9];
	$n=(float)$data[10];
	$sql2="insert into exam_question values('$data[0]','$data[1]',$qno,'$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]',$p,$n)";
	$res2=mysql_query($sql2);

}
mysql_query("delete from exam_quescache where test_id='$testid'");
header("location:admin.php");
?>