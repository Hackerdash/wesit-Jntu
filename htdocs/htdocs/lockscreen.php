<?php
session_start();
error_reporting(E_PARSE);
include("connection.php");
$sid=$_SESSION['loginrollno'];
$examid=$_SESSION['tid'];
$sql=mysql_query("select status from registeredstudents where examid='$examid' and rollno='$sid'");
$data=mysql_fetch_row($sql);
if($data[0]=='running')
{
	header("Location:interface.php");
}
?>
<html>
<head><title>LOCKED SCREEN</title></head>
<style>
body{
	font-family: sans-serif;
}
</style>
<noscript><meta http-equiv="refresh" content="1;url=errornojs.html"></noscript>

<body>
	<center>
		<img src="moniter/images/locked.jpg" width="400" height="300">
		<br/>
		<h2>Your session has been locked</h2>
	</center>
<h4>The reason for locking your session</h4>
<ol>
<li>The invigilator might have locked your session.</li>
<li>you might attempted for unauthorized login.</li>
<li>you might have tried for copying</li>
</ol>
	<center>
		<h2 style="color:#33ccff;">Contact your session invigilator for unlocking your session</h2>
		<h5 style="color:red;">The decision regarding unlocking and adding extra time to  your session by invigilator is final</h5>
	</center>
</html>