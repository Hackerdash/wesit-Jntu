<?php
session_start();
error_reporting(E_ERROR || E_PARSE);
include("connection.php");
date_default_timezone_set('Asia/Kolkata');
$testid=$_GET['tid'];
$id=$_SESSION['loginrollno'];
if(isset($_SESSION['loginrollno']))
{
	if(isset($_COOKIE[$testid]))
	{
		$oid=$_COOKIE[$testid];
		if($id==$oid)
		{
			header("Location:examintro.php?tid=$testid");
		}
		else
		{

			header("Location:fraudattempt.php?tid=$testid");

		}
	}
	else
	{
		setcookie($testid,$id, time() + (86400*7),"/");
		header("Location:examintro.php?tid=$testid");
	}
}
else
{
	header("Location:index.php");
}
?>