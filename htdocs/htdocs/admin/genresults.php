<?php
session_start();
error_reporting(E_PARSE || E_FETCH);
include("db.php");
$deptid=$_SESSION['dept'];
?>
<html>
<head>
<style>
body{
	font-family: sans-serif;
	color:maroon	;
}
#backlink{
position:absolute;
top:15%;
left:80%;
}
</style>
<title>RESULTS | OES</title>
<link rel='stylesheet' href="css/style2.css">
</head>
<body bgcolor="#c0c0c0">
<center>
<h2>JNTUACEP | Online Examination System</h2>
<h1>Results</h1>
<a id="backlink" href="admin.php">go to home</a><br/><br/>

<form id="formnew" name="formnew" action="dispresults.php" method="post">
select an Exam:<select id="examselect" name="examselect" style="width:200px;height:30px;border-radius:3px">
<?php
$sql3="select test_id,test_name from exam_test where dept='$deptid'";
$res=mysql_query($sql3);
while($data=mysql_fetch_row($res))
{
	echo "<option value='$data[0]'>".$data[1]."</option>";
}
?>
</select>
<br/><br/>
<input type="submit" name="submit" id="submit" value="Get results!" style="width:200px;height:30px"> 
</form>

</center>
</body>
</html>