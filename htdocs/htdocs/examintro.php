<?php
session_start();
$_SESSION['tid']=$_GET['tid'];
$eid=$_SESSION['tid'];
$stid=$_SESSION['loginrollno'];
include("connection.php");
$sqlstmt="select * from exam_test where test_id='".$_SESSION['tid']."'";
$sqlresult=mysql_query($sqlstmt);
$sqldata=mysql_fetch_row($sqlresult);
$_SESSION['timer']=(int)$sqldata[4]*60;
$fraudsql=mysql_query("select * from registeredstudents where  examid='$eid' and rollno='$stid'");
$frdata=mysql_fetch_row($fraudsql);
if($frdata[3]=='absent')
{
	header("Location:absentlogin.php");
}
if($frdata[3]=='running'||$frdata[3]=='incomplete'||$frdata[3]=='locked')
{
	$curaddr=$_SERVER['REMOTE_ADDR'];
	if($curaddr!=$frdata[2])
	{
		
	}
}




?>
<html>
<head>
<title>Exam Introduction</title>
<noscript><meta http-equiv="refresh" content="1;url=errornojs.html"></noscript>
<script language=JavaScript> var message="Function Disabled!"; function clickIE4(){ if (event.button==2){ alert(message); return false; } } function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ alert(message); return false; } } } if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; } document.oncontextmenu=new Function("alert(message);return false") </script>
<style type="text/css">
#intro{
background-color:white; 
width:100%;
height:110%;
border-radius: 5px;
position: relative;
top:0%;
left:0%;
padding: 30px;
 }
body{
	background-color:white;
	font-family: sans-serif;
	font-size: 20px;
}
#table1{
	font-size: 25px;
	color:black;
	}
body{
	color:brown;
}
input{
width:170px;
height:33px;
background-color: green;
color:white;
border-radius: 4px;	
}

</style>
</head>
<body ondragstart="return false" onselectstart="return false">
	<script language=JavaScript> var message="Function Disabled!"; function clickIE4(){ if (event.button==2){ alert(message); return false; } } function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ alert(message); return false; } } } if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; } document.oncontextmenu=new Function("alert(message);return false") </script>

	<?php
include "header.php";

	?>
<h2>Examination Instructions</h2>
<div id="intro">
	<div id="tableintro">
	<table border=1px id="table1" cellpadding=10px>
		
		<tr>
			<td>Exam Name</td>
			<td><?php echo $sqldata[2]; ?></td>
		</tr>
		<tr>
			<td>No.of Questions</td>
			<td><?php echo $sqldata[3]; ?></td>
		</tr>
		<tr>
			<td>Exam Duration</td>
			<td><?php echo $sqldata[4]." mins"; ?></td>
		</tr>
	</table>
	
		<p>This web portal is under development and our team is continously striving for the better providence of service. If you face any Technical/Subject/Language/Format error, you are requested to notify us through feedback.</p>
		<a href="starttest.php"><input type="submit" name="submit" id="submit" value="take test"></a>
	</form>
	</div>
</div>
</body>
</html>