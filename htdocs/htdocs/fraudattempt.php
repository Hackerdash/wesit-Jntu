<?php
session_start();
include 'connection.php';
error_reporting(1);
date_default_timezone_set('Asia/Kolkata');
$tid=$_GET['tid'];
$sroll=$_SESSION['loginrollno'];
echo "Student rollno is :".$_SESSION['loginrollno'];
if(isset($_POST['submit']))
{
$sql="select password from exam_moniters where exam_id='$tid'";
$res=mysql_query($sql);
$data=mysql_fetch_row($res);
$pwd=$_POST['upwd'];
if($pwd==$data[0])
{
        setcookie($tid,$sroll,time() + (86400*7),"/");
header("Location:examintro.php?tid=$tid");

}
else
{
}
}

?>
<html>
<style>
body{
	font-family:sans-serif;

}
</style>
<body>
<center>
<img src="moniter/images/locked.jpg" width="400" height="300"><br/>
<font style=color:red>UNAUTHENTICATED LOGIN </font>
<h2>your session is locked...call your session invigilator for unlocking your system</h2>
<form action="" method="POST"><br/>
enter unlocking password:<input type="password" name="upwd" id="upwd" />
<br/><br/>
<input type="submit" name="submit" id="submit" value="Authenticate" style="color:white;background-color:green;width:200px,height:28px">

</form> 
</center>
</body>
</html>