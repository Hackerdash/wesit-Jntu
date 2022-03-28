<?php
session_start();
include 'db.php';
include 'tickabsent.php';
error_reporting(E_PARSE||E_FETCH);
echo '<img src="../images/header2.png">';
if(!$_SESSION['dept'])
{
header("Location:index.php");
}
$dept=$_SESSION['dept'];
$examid=$_SESSION['testid'];
$sql1="select * from registeredstudents where examid='$examid' order by rollno";
$res=mysql_query($sql1);
$sql2="select * from exam_test where test_id='$examid'";
$res2=mysql_query($sql2);
$data=mysql_fetch_row($res2);
?>
<head>
<meta http-equiv="refresh" content="30" />
<style>
#clientall
{
	background-color: #ccc;
	color:white;

}
#titles
{
width:100%;
background-color:#F0F0F5;
border-radius: 4px;
color:#1AD1FF;
font-family: sans-serif;
padding: 10px;
}
th
{
	color:blue;
}
table{
	font-family: sans-serif; 	
}
</style>
</head>
<body bgcolor="#fff">
<center>
<div id="titles">
<h2>Welcome to JNTUACEP</h2>
<h1>Online Examinations | Session Monitering System</h1>
<h3>Test name is :<?php echo $data[2]."&nbsp&nbsp";?> Test date is :<?php echo $data[5]."&nbsp&nbsp";?> Test time is :<?php echo $data[6]."&nbsp&nbsp";?></h3>
</div>
</center>
<div id=clientall>
<table cellpadding=10px border=1 style="text-align:center;">
<tr>
<th width=10%>student image</th>
<th width=20%>Details</th>
<th width=10%>Exam status</th>
<th width=10%>Lock Status</th>
<th width=10%>Tools</th>
<th width=40%>Remarks</th>
</tr>
<?php

while($data1=mysql_fetch_row($res))
{
	$roll=$data1[1];
	$stat=$data1[3];

	$res3=mysql_query("select * from exam_timer where testid='$examid' and userid='$roll'");
	$lockdata=mysql_fetch_row($res3);
	if($data1[3]=='absent')
	{
		$disp="TICK PRESENT";
		$link="tickpresent.php?eid=$examid&stuid=$roll";
		
	}
	elseif($data1[3]!='completed')
	{
		if($lockdata[4]=='Unlocked')
		{
			$disp="LOCK";
			$link="lock.php?eid=$examid&stuid=$roll";
		}
		else
		{
			$disp="UNLOCK";
			$link="unlock.php?eid=$examid&stuid=$roll";
		}
	}
	else
	{
		$link="";
		$disp="completed";
	}
	
	echo "<tr><td rowspan=3><img src='../students/$roll.jpg'/></td><td>Roll no:$roll</td><td rowspan=3><img src='images/$stat.jpg'/></td><td>$lockdata[4]</td><td><a href=$link>$disp</a></td></tr>";
	echo "<tr><td>Ip Address:".$_SERVER['REMOTE_ADDR']."</td></tr>";
	echo "<tr><td>status:$data1[3]</td></tr>";

}

?>
</table>
</div>
<div id="extratools">
<center>
<?php
$finalsql=mysql_query("select * from registeredstudents where status='running' and examid='$examid'");
$finaldata=mysql_num_rows($finalsql);
if($finaldata==0)
{
	echo "<a href=wrapsession.php?eid=$examid><input type=button style=width:200px;height:32px;background-color:red;color:white value=EndExam name=finish id=finish onclick='return fun1()'/></a>";
}
?>
</center>
</div>
</body>
</head>
</html>