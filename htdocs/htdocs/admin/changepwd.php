<?php
session_start();
error_reporting(1);
include 'db.php';
$deptname=$_SESSION['dept'];
date_default_timezone_set('Asia/Kolkata');
if(isset($_POST['submit']))
{

	$pwd=$_POST['pwd1'];
	$pin=(int)$_POST['pwd2'];
	$oldpin=(int)$_POST['pinold'];
	$oldpwd=$_POST['pwdold'];
	$data=mysql_fetch_row(mysql_query("select * from exam_admin where dept='$deptname'"));
	if($data[1]==$oldpwd && (int)$data[2]==$oldpin)
	{
		$sql="UPDATE `exam_admin` SET `password`='$pwd',`pin`=$pin WHERE `dept`='$deptname'";
	$res=mysql_query($sql);
	}
}
?>
<html>
<head><title>Change Admin Password</title>
<link href="../css/style2.css" rel="stylesheet" type="text/css">
<style>
body{
	font-family: sans-serif;
}
</style>
</head>
<body>
<img src="../images/header2.png"/>
<div id="options">
<center>
<ul>
<li><a href="admin.php">Home</a></li>
<li><a href="signout.php">Signout</a></li>
</ul>
</center></div>
<center>	<h2>change your password and pin </h2>
	<form action="" method="POST">
		<table><tr>
		<td>Enter your old password:</td><td><input type="password" name="pwdold" id="pwdold"/></td></tr>

		<tr><td>Enter your old pin:</td><td><input type="password" name="pinold" id="pinold"/></td></tr>


		<tr><td>Enter your new password:</td><td><input type="password" name="pwd1" id="pwd1"/></td></tr>

		<tr><td>Enter your new pin:</td><td><input type="password" name="pwd2" id="pwd2"/></td></tr>
	
		<table><br/><br/>
		<input type="submit" name="submit" value="change password and pin"/>
		
	</form>
<div id="result" style="color:red">
<?php
if($res=='true')
	{
		echo "your new password is:$pwd<br/>your new pin is:$pin";
	}
else if($res=='false')
	{
		echo "your password is not yet changed!! ";
	}
else
{
	echo "";
}
?>
</div>
</center>
</body>
