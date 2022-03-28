<?php
session_start();
error_reporting(1);
$deptname=$_SESSION['dept'];
include "db.php";
$tid=$_GET['tid'];
$sql1="delete from registeredstudents where examid='$tid'";
$res=mysql_query($sql1);
$sql2="delete from exam_moniters where exam_id='$tid'";
$res=mysql_query($sql2);
$sql3="delete from exam_quescache where test_id='$tid'";
$res=mysql_query($sql3);
$sql4="delete from exam_question where test_id='$tid'";
$res=mysql_query($sql4);
$sql5="delete from exam_session where examid='$tid'";
$res=mysql_query($sql5);
$sql6="delete from feedbacks where examid='$tid'";
$res=mysql_query($sql6);
$sql7="delete from results where test_id='$tid'";
$res=mysql_query($sql7);
$sql8="delete from exam_test where test_id='$tid'";
$res=mysql_query($sql8);
$sql9="delete from exam_timer where test_id='$tid'";
$res=mysql_query($sql9);
header("Location:viewexams.php");
?>