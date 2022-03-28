<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
$testid=$_GET['eid'];
$roll=$_GET['stuid'];
include 'db.php';
error_reporting(E_PARSE||E_FETCH);
$getsql=mysql_query("select * from exam_timer where userid='$roll' and testid='$testid'");
$data=mysql_fetch_row($getsql);
$locktime=$data[5];
$lock=strtotime($locktime);
$curtime=date("20y-m-d H:i:s");
$cur=strtotime($curtime);
$diff=$cur-$lock;
$realtime=strtotime($data[3]);
$ends=date("20y-m-d H:i:s",strtotime("+ $diff seconds",$realtime));
$sql="UPDATE `exam_timer` SET `status`='Unlocked',`locktime`='0000-00-00 00:00:00',`endtime`='$ends' WHERE userid='$roll' and testid='$testid'";
mysql_query($sql);
$sql2="UPDATE registeredstudents set status='running' where examid='$testid' and rollno='$roll'";
mysql_query($sql2);
header("Location:moniter.php");
?>