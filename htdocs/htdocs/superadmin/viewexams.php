<?php
session_start();
error_reporting(1);
include "db.php";


if(isset($_POST['delexam']))
{
  var_dump($_POST['examid']);

}
?>
<link href="../css/style2.css" rel="stylesheet" type="text/css">
<style>
form{
    font-family: sans-serif;
    font-size:28px;
}

p{
    color:black;
    position: absolute;
    top:36%;
    left:37%;
}
#fdback{
  position:absolute;
  top:60%;
  left: 15%;
  font-family: sans-serif;
  font-size: 20px;
  font-color:olive;
}
</style>
<script>
function confirmfinish()
{
  var x=confirm("Are you sure to Schedule the exam ?");
  if(x==true)
  {
    return true;

  }
  else
  {
    return false;
  }
} 
</script>
<body>
<img src="../images/header2.png"/>
<div id="options">
<center>
<ul>
<li><a href="admin.php">Home</a></li>
<li><a href="signout.php">Signout</a></li>
</ul>
</center></div>
<center><h2 id="head3">View exams of all departments</h2>
<div id="fdback">
<form action="" method="post">
<table id="fbacktable" width="100%" cellpadding="5px" border="1px black">
<tr><th>Department</th><th>Exam id</th><th>Exam Name</th><th>Total questions</th><th>Total Time</th><th>Date of exam</th><th>Time of exam</th><th>Tools</th> 
<?php
$res=mysql_query("select * from exam_test order by dept");
while($data=mysql_fetch_row($res))
{
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
  echo($data[5]);
  echo("</td>");
  echo("<td>");
  echo($data[6]);
  echo("</td>");
  echo("<td>");
  echo("<a href='scheduleexam.php?tid=$data[0]'><input type=button name=delexam id=delexam value='Manage Exam Timings' onclick='return confirmfinish()' >");
  echo("</td>");
  echo("</tr>");
}
?>
</table>
</form>
</div>

</center>

</body>