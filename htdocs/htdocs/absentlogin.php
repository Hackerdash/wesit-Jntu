<?php
session_start();
include 'connection.php';
error_reporting(1);
date_default_timezone_set('Asia/Kolkata');
echo "The user login id is:".$_SESSION['loginrollno'];
?>
<html>
<head><title>ABSENT SCREEN</title>
<noscript><meta http-equiv="refresh" content="1;url=errornojs.html"></noscript>
</head>
<style>
body{
	font-family: sans-serif;
}
</style>
<body>
	<center>
		<img src="moniter/images/absent.jpg" width="400" height="300">
		<br/>
		<h2>Your session has been marked as absent </h2>
	</center>
<h4>The reason for locking your session</h4>
<ol>
<li>You are late of 30 mins to the exam</li>
</ol>
	<center>
		<h2 style="color:#33ccff;">Contact your session invigilator for unlocking your session</h2>
		<h5 style="color:red;">The decision regarding unlocking and adding extra time to  your session by invigilator is final</h5>
	</center>
</html>