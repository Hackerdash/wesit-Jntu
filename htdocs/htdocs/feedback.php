<?php
session_start();
include("connection.php");
$stuid=$_SESSION['loginrollno'];
$examid=$_SESSION['tid'];
$dep=$_SESSION['department'];
$whatday=date("d-m-20y");
if(isset($_POST['submit']))
{
	$review=$_POST['feedback'];
	$sql="insert into feedbacks values('$stuid','$examid','$dep','$review')";
	$res=mysql_query($sql);
	header("Location:exam.php");
}
?>
<html>
<head>
<link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet' type='text/css'>
<title>Feedback us | Epic online exam</title>
<style type="text/css">
body{
	color:white;
	font-family: 'Nunito',cursive;
}
h1{
	font-size: 30px;
}
#feedback{
	border-radius: 5px;
	width:40%;
}
#submit{
width:160px;
height:30px;
}
</style>

</head>
<body background="images/feedback.jpg">
<center>
<h3>Your result has been generated..</h3>
<h1>Thank you for Attempting the online exam....please give us a feedback/suggestion/technical problem to us..so that we will strive for the development of the portal..</h1>
<form action="" method="POST">
<textarea name="feedback" id="feedback"  rows=10 cols=20>

</textarea>
<br/>
<input type="submit" name="submit" id="submit" value="post feedback">
</form>




</center>
</body>
</html>
