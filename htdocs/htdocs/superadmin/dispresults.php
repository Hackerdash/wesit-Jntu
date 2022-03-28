<?php
session_start();
error_reporting(E_PARSE || E_FETCH);
include("db.php");
$deptid=$_SESSION['dept'];
$testid=$_POST['examid'];
$detsql="select test_name,dateofexam from exam_test where test_id='$testid'";
$detres=mysql_query($detsql);
$detdata=mysql_fetch_row($detres);



$namesql="select * from registeredstudents where examid='$testid' order by rollno";
$nameres=mysql_query($namesql);
?>
<html>
<head>
<style>
body{
	font-family: sans-serif;
	color:maroon	;
}

</style>
<title>RESULTS | OES</title>
<link rel='stylesheet' href="css/style2.css">
</head>
<body bgcolor="#fff">
<center>
<h2>JNTUACEP | Online Examination System</h2>
<h1>Results</h1>


<div id="resultarea">
<table align="center" width="90%" border=1>
	<tr><th colspan=8>JNTUA COLLEGE OF ENGINEERING(AUTONOMOUS)::PULIVENDULA</th></tr>
	<tr><th colspan=8>ONLINE EXAMINATION SYSTEM::RESULTS</th></tr>
	<tr><td colspan=1>Exam Name</td><td colspan=3><?php echo $detdata[0];?></td><td colspan=2>Date of Exam</td><td colspan=2><?php echo $detdata[1]; ?></td>
	<tr><th>Rollno</th><th>Name</th><th>No.of correct</th><th>No.of Wrong</th><th>No.of unattempt</th><th>Total marks</th><th>Result</th><th>Credits</th></tr>
<?php
while($data=mysql_fetch_array($nameres))
{
	$names=$data[1];
	$sqll="select stuname from students where id='$names' ";
	$sqllres=mysql_query($sqll);
	$sqlldata=mysql_fetch_row($sqllres);
	$res="select * from results where test_id='$testid' and rollno='$names'";
	$resres=mysql_query($res);
	if(mysql_num_rows($resres)==1)
{
	$datas=mysql_fetch_row($resres);
	$umar=$datas[2];
	$tmar=$datas[6];
	$per=($umar/$tmar)*100;
	if($per>=40.0)
	{
		$result='P';
		$credit=1;

	}
	else
	{
		$result='F';
		$credit=0;
	}
	echo "<tr><td>$names</td><td>$sqlldata[0]</td><td>$datas[3]</td><td>$datas[4]</td><td>$datas[5]</td><td>$umar</td><td>$result</td><td>$credit</td></tr>";
}
else
{
echo "<tr><td>$names</td><td>$sqlldata[0]</td><td> - </td><td>-</td><td>-</td><td>-</td><td>AB</td><td>0</td></tr>";
}
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
<br/>
<input type="button" value="print" id="print" style="width:200px;height:30px;" onclick="window.print();"/>
<a id="backlink" href="admin.php">go to home</a><br/><br/>
</center>


</body>
</html>