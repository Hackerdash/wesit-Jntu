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
    $rs=mysql_query("select * from exam_moniters where userid='$loginid' and password='$pass' and dept='$pass2'");
	if(($res=mysql_num_rows($rs))<1)
	{  
		$found="n";

	}
	else
	{
        $data=mysql_fetch_row($rs);
        $_SESSION['testid']=$data[0];
        $_SESSION['dept']=$pass2;
        header("location:moniter.php");
	}    
}






?>
<html>
<head>
<title>Moniter | login</title>
<style>

</style>
<link rel="stylesheet" href="../css/style.css"/>
<link rel="stylesheet" href="../css/style2.css"/>
</head>
<body>
<img src="../images/header2.png" width="100%" />

<center> 
<h2 style="position: absolute; top:35%; left:35%; font-size:30px; color:teal;">Welcome to Exam Monitering login</h2>
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
<td>Department</td>
<td><select id="pwd2" name="pwd2"><option value="CIV">Civil</option>
<option value="EEE">Electrical and Electronics</option>
<option value="MECH">Mechanical</option>
<option value="ECE">Electronics and communications</option>
<option value="CSE">Computer Science</option>
<option value="BIO-TECH">Bio-Technology</option>
</select></td>
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