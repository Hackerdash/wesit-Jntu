<?php
session_start();
error_reporting(E_PARSE || E_FETCH);
$testid=$_GET['tid'];
include("connection.php");
$stuid=$_SESSION['loginrollno'];

if(isset($_SESSION['loginrollno'])&&isset($_GET['tid']))
{
	$sqlst = "SELECT * FROM results where test_id='$testid' and rollno='$stuid' order by marks desc";
	$result2=mysql_query($sqlst);
	if(mysql_num_rows($result2)==1)
	{
		$error='n';
	}
	else
	{
		$error='y';
	}
                
}

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
<a id="backlink" href="exam.php">go to home</a><br/><br/>


<div id="resultarea">
<table align="center" width="60%" border=1>
	<tr><th>Rollno</th><th>No.of correct</th><th>No.of Wrong</th><th>No.of unattempt</th><th>Total marks</th></tr>
<?php
while($data=mysql_fetch_array($result2))
{
	echo "<tr><td>$data[1]</td><td>$data[3]</td><td>$data[4]</td><td>$data[5]</td><td>$data[2]</td></tr>";
}

?>
</table>
</div>
<div id="messagearea">
<?php
if(isset($error))
{
if($error=='n')
{
	echo "result sucessfully generated";
}
else
{
	echo "Still results not generated or you have not attempted the test !";
}
}
?>
</div>
</center>
</body>
</html>