<?php
session_start();
error_reporting(1);
include "db.php";
$tid=$_GET['tid'];
$tid2=$tid;
echo "<img src='../images/header2.png'/>";
echo "<center><h1>Schedule Exam timings</h1></center>";
if(isset($_POST['submit']))
{

	$newdate=$_POST['newdate'];
	echo "The new date is &nbsp".$newdate;
	$newtime=$_POST['newtime'];
	echo "&nbsp&nbsp&nbsp and time is &nbsp".$newtime."&nbsp status is ";
  
	$sql=mysql_query("update exam_test set dateofexam='$newdate',start_time='$newtime' where test_id='$tid'");
	if($sql=='true')
		{
			echo "updated!!";
		}
	else if($sql=='false')
		{
			echo " notupdated!!";
		}
  
 

		
}



?>
<html>
<link href="../css/style2.css" rel="stylesheet" type="text/css">
<style>
input{
	width:220px;
	height:30px;
}
</style>
<div id="options">
<center>
<ul>
<li><a href="admin.php">Home</a></li>
<li><a href="signout.php">Signout</a></li>
</ul>
</center></div>
<form action="" method="post">
<table id="fbacktable" width="100%" cellpadding="4px" border="2px black" style="text-align:center;">
<tr><th>Department</th><th>Exam id</th><th>Exam Name</th><th>Total questions</th><th>Total Time</th><th>Date of exam</th><th>Time of exam</th><th>Tools</th> 
<?php
$res=mysql_query("select * from exam_test where test_id='$tid'");

while($data=mysql_fetch_row($res))
{
echo "<tr style='color:green;font-family:sans-serif;'><td colspan=8>The exam has been scheduled on ".$data[5]." at &nbsp".$data[6]."</td></tr>"; 

  echo("<tr>");
  echo("<td>");
  echo($data[7]);
  echo("</td>");
  echo("<td>");
  echo($data[0]);
  echo("</td>");
  echo("<td>");
  echo($data[2]);
  echo("</td>");
  echo("<td>");
  echo($data[3]);
  echo("</td>");
  echo("<td>");
  echo($data[4]);
  echo("</td>");
  echo("<td>");
  echo("<input type=date name='newdate' id='newdate' placeholder=$data[5]>");
  echo("</td>");
  echo("<td>");
  echo("<input type=text name='newtime' id='newtime' placeholder=$data[6]>");
  echo("</td>");
  echo("<td>");
  echo("<input type=submit name=submit id=submit value='schedule it !'>");
  echo("</td>");
  echo("</tr>");
}
?>
</table>
</form>