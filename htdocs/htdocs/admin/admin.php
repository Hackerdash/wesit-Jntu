<?php
session_start();
include('db.php');
$uname=$_SESSION['login'];
?>
<html>
<head>
	<style>
	#detailss
	{
		position:absolute;
		top:38%;
		left:3%;
		font-family: sans-serif;
		color:white;
		font-size:20px;
		background-color: blue;
		padding:30px;


	}
	</style>
<title>admin tools</title>
<link rel="stylesheet" href="../css/style2.css"/>
</head>
<body>
<?php
$sqlname="select * from exam_admin where uname='$uname'";
$nameres=mysql_query($sqlname);
$namedata=mysql_fetch_row($nameres);

?>
<img src="../images/header2.png"/>
<center><h2 id="head1">Welcome to Admistrative Console </h2></center>
<div id="options">
<center>
<ul>
<li><a href="admin.php">Home</a></li>
<li><a href="signout.php">Signout</a></li>
</ul>
</center></div>
<div id="detailss">
<h3>Admin Details</h3>
<h4>Name:<?php echo($namedata[3]);?></h4>
<h4>Dept:<?php $_SESSION['dept']=$namedata[4]; echo($namedata[4]);?></h4>

</div>
<div id="list" style="margin-left:20%;padding-top:5%">
<center>
<p class="style7"><a href="addcat.php">Add Subject/category</a></p>
<p class="style7"><a href="addtest.php">Add Exam</a></p>
<p class="style7"><a href="addstudents.php">Add Students to Exam</a></p>
<p class="style7"><a href="addmoniters.php">Add Invigilators to Exam</a></p>
<p class="style7"><a href="addexcelfile.php">Add Excel file</a></p>
<p align="center" class="head1">&nbsp;</p>
<!--<p class="style7"><a href="modstudents.php">View/Modify Students Data</a></p>
<p class="style7"><a href="modquestion.php">View/Modify Question</a></p>-->
<p align="center" class="head1">&nbsp;</p>

<p class="style7"><a href="viewexams.php">View Your Exams</a></p>
<p class="style7"><a href="genresults.php">Generate Results</a></p>
<p class="style7"><a href="viewfeedbacks.php">View feedbacks</a></p>
<p class="style7"><a href="changepwd.php">Change Password</a></p>
</center> </div>

</body>

</html>