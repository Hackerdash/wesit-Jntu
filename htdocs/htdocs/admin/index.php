<?php
session_start();
include 'db.php';
extract($_POST);
if(isset($_POST['submit']))
{
    $loginid=$_POST['uname'];
    $pass=$_POST['pwd1'];
    $pass2=$_POST['pwd2'];
    error_reporting(E_ERROR || E_PARSE);
    $rs=mysql_query("select * from exam_admin where uname='$loginid' and password='$pass' and pin='$pass2'");
	if(($res=mysql_num_rows($rs))<1)
	{  
		$found="n";

	}
	else
	{
		$_SESSION[login]=$loginid;
        header("location:admin.php");
	}    
}






?>
<html>
<head>
<title>Admin epic exam</title>
<style>

</style>
<link rel="stylesheet" href="../css/style.css"/>
<link rel="stylesheet" href="../css/style2.css"/>
</head>
<body>
<img src="../images/header2.png" width="100%" />
<!--	<div id="header_title">
    <center>
    <span id="maintitle"><h1>Online Examination System</h1></span>
    <h3>EPIC, Department of Computer Science and Engineering</h3>
    <h3>JNTU Pulivendula</h3>
    </center>
    </div><br /><br />--!>
<center>
<h2 style="position: absolute; top:35%; left:35%; font-size:30px; color:teal;">Welcome to administrative login</h2>
<form action="" method="POST">
<table id="content" width="600px">
<tr align="center">
<td>username</td>
<td><input type="text" id="uname" name="uname" /></td>
</tr>
<tr align="center">
<td>password</td>
<td><input type="password" id="pwd1" name="pwd1" /></td>
</tr>
<tr align="center">
<td>secure pin</td>
<td><input type="password" id="pwd2" name="pwd2" /></td>
</tr>
<tr align="center">
<td><br /></td>
</tr>
<tr align="center">
<td>

</td>
</tr>
</table>
<input type="submit" name="submit" id="submit" value="login" style="position: absolute; top: 68%; left:40%"/>
</form>
 <span id="error">
     <?php
     if(isset($found))
     {
     echo("*check your creditinals once");
     }
     ?>
     </span>




<h2 style="position: absolute; top:90%; left:44%">copyrights @ Jntuacep</h2>

</center>
</body>
</html>