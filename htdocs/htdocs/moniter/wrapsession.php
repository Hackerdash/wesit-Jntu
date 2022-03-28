<?php
session_start();
include 'db.php';
error_reporting(E_PARSE||E_FETCH);
$eid=$_GET['eid'];
$sql1=mysql_query("delete from exam_timer where testid='$eid'");
$sql2=mysql_query("delete from exam_moniters where exam_id='$eid' ");
$sql3=mysql_query("delete from exam_session where examid='$eid'");
header("Location:index.php");
?>