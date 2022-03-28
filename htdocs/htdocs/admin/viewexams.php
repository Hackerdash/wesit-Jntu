<?php
session_start();
error_reporting(1);
$deptname=$_SESSION['dept'];
include "db.php";

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
  top:80%;
  left: 15%;
  font-family: sans-serif;
  font-size: 20px;
  font-color:olive;
}
</style>
<script>
function confirmfinish()
{
  var x=confirm("Are you sure to Delete the exam data (Exam details, student details, moniters, exam questions) ?");
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
<center><h2 id="head3">View / Delete your exams</h2>
<div id="fdback">
<form action="" method="post">
<table id="fbacktable" width="100%" cellpadding="5px" border="1px black"> 
<?php
$res=mysql_query("select * from exam_test where dept='$deptname' ");
while($data=mysql_fetch_row($res))
{
  echo("<tr>");
  echo("<td>");
  echo($data[0]);
  echo("</td>");
  echo("<td>");
  echo($data[1]);
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
  echo($data[8]);
  echo("</td>");
  echo("<td>");
  echo($data[9]);
  echo("</td>");
  
  echo("<td>");
  echo("<a href='delexam.php?tid=$data[0]'><input type=button name=delexam id=delexam value='delete details' onclick='return confirmfinish()' >");
  echo("</td>");
  echo("</tr>");
}
?>
</table>
</form>
</div>

</center>

</body>