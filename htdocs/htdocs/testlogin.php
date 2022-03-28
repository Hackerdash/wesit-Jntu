<?php
session_start();
$id=$_SESSION['loginrollno'];
$ip=$_SERVER['REMOTE_ADDR'];
$sql=mysql_query("select * from registeredstudents where logging='$ip' and rollno='$id'");
if(mysql_num_rows($sql)==0)
{
	
}

