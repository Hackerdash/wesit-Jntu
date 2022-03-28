<?php
session_start();
error_reporting(1);
$deptname=$_SESSION['dept'];
$uname=$_SESSION['login'];
/*if (!isset($_SESSION['alogin']))
{
	echo "<br><h2>You are not Logged On Please Login to Access this Page</h2>";
	echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
}*/

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

<body>
<img src="../images/header2.png"/>
<div id="options">
<center>
<ul>
<li><a href="admin.php">Home</a></li>
<li><a href="signout.php">Signout</a></li>
</ul>
</center></div>
<center><h2 id="head3">Feedback page</h2></center>


<form name="form1" id="form1" method="post">
  <table width="58%"  border="0" align="center">
    <tr>
      <td width="49%" height="32"><div align="left"><strong>Select an Exam</strong></div></td>
      <td width="3%" height="5">  
      <td width="48%" height="32"><select name="subid">
<?php
$rs=mysql_query("Select * from exam_test where dept='$deptname'");
	  while($row=mysql_fetch_array($rs))
{
if($row[0]==$subid)
{
echo "<option value='$row[0]' selected>$row[2]</option>";
}
else
{
echo "<option value='$row[0]'>$row[2]</option>";
}
}
?>
      </select>
      
    <tr>
      <td height="26"></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Get Feedbacks" ></td>
    </tr>
  </table>
</form>
<p>&nbsp; </p>
<center>
<div id="fdback">
<table id="fbacktable" width="90%" cellpadding="10px" border="1px black"> 
<tr>
  <th>Roll no</th>
  <th>Feedback given</th>
  <th>options</th>
</tr>
<?php
if(isset($_POST[submit]))
{
$tids=$_POST['subid'];
$res=mysql_query("select * from feedbacks where dept='$deptname' and examid='$tids' order by rollno");
$i=0;
while($data=mysql_fetch_row($res))
{
  echo("<tr>");
  echo("<td>");
  echo($data[0]);
  echo("</td>");
  echo("<td>");
  echo($data[3]);
  echo("</td>");
  echo("<td>");
  echo("<input type=checkbox name=opt id=opt >");
  echo("</td>");
  echo("</tr>");
}
}
?>
</table>
</div>

</center>

</body>