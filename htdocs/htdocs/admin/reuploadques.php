<?php
//proceed uplaoding of questions
session_start();
error_reporting(1);
include 'db.php';
$testid=$_GET['testid'];
$res2=mysql_query("delete from exam_quescache where test_id='$testid'");
header("location:admin.php");
?>