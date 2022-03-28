<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$testid=$_GET['eid'];
$roll=$_GET['stuid'];
include 'db.php';
error_reporting(E_PARSE||E_FETCH);
$t=date("20y-m-d H:i:s");
$sql="UPDATE `exam_timer` SET `status`='Locked',`locktime`='$t' WHERE userid='$roll' and testid='$testid'";
mysql_query($sql);
$sql2="UPDATE registeredstudents set status='locked' where examid='$testid' and rollno='$roll'";
mysql_query($sql2);
header("Location:moniter.php");

?>