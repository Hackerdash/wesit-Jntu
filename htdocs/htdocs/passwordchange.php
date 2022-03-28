<?php
session_start();
error_reporting(E_ERROR || E_PARSE);
mysql_connect("localhost","jntuacep_oes","jntuacep");
mysql_select_db("jntuacep_oes");
date_default_timezone_set('Asia/Kolkata');
if(isset($_POST['submit']))
{
if($_POST['pwd1']!=$_POST['pwd2'])
{
echo "<script>alert('passwords not matched!!');</script>";
}
else
{
	$pwd=$_POST['pwd1'];
	$roll=$_SESSION['loginrollno'];
	$sql=mysql_query("update students set password='$pwd' where id='$roll'");
	header("Location:exam.php");
}
}
?>
<body>
<center>
	<h2>you are logged in to the portal...It seems your password is not secure..so change your password for better security</h2>
	<form action="" method="POST">
		Enter your new password:<input type="password" name="pwd1" id="pwd1"/><br/><br/>
		Re-enter your password:<input type="password" name="pwd2" id="pwd2"/><br/><br/><br/>
		<input type="submit" name="submit" value="change password"/>
	</form>
</center>
</body>
