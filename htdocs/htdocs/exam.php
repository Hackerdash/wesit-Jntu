<?php
session_start();
error_reporting(E_ERROR || E_PARSE);
mysql_connect("localhost","jntuacep_oes","jntuacep");
mysql_select_db("jntuacep_oes");
date_default_timezone_set('Asia/Kolkata');
include 'disablekeys.php';
if(!isset($_SESSION['loginrollno']))
{
    session_destroy();
    header("location:index.php");
} 


$_SESSION['loginrollno']=strtoupper($_SESSION['loginrollno']);
$src="students/".$_SESSION['loginrollno'].".jpg";

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style2.css"/>
<title>exam topics</title>
<noscript><meta http-equiv="refresh" content="1;url=errornojs.html"></noscript>

<style>
body{
    font-family:sans-serif;
    color:#99CC00;
}
#display1{
    font-size:20px;
    padding:10px;
    
    
}
#uoptions{
	position: absolute;
	top:5%;
	left:80%;

}
#displaytime
{
	position: absolute;
	top:1%;
	left:1%;
}
</style>
<script language=JavaScript> var message="Function Disabled!"; function clickIE4(){ if (event.button==2){ alert(message); return false; } } function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ alert(message); return false; } } } if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; } document.oncontextmenu=new Function("alert(message);return false") </script>
<script type="text/javascript">
function fun2()
{
	document.getElementById('instable').style.visibility="visible";
}
function fun3()
{
	document.getElementById('instable').style.visibility="hidden";
}
</script>
</head>

<body ondragstart="return false" onselectstart="return false">

<div id="header">
<center>
<h1></h1>

</center>
</div>
<div id="displaytime"> 
	<table style="padding:16px;">
	<?php
	echo "<tr><td rowspan=3 width=100px>"."<img src=$src />"."</td>";
	echo "<td>"."user login id is :".$_SESSION['loginrollno']."</td>";
	
	date_default_timezone_set('Asia/Kolkata');
	echo "<tr><td>"."Current date is ".date("20y/m/d")."<td></tr>"; 
	echo "<tr><td>"."Current time is ".date("H:i:s")."</td></tr>";

	?>
	</table>
</div>

<?php
$ids=$_SESSION['loginrollno'];
$getname = "SELECT `stuname`,`department` FROM `students` WHERE id='$ids'";
$res=mysql_query($getname);
$names=mysql_fetch_row($res);
$_SESSION['stuname']=$names[0];
$_SESSION['department']=$names[1];
?>
<center>
<br/><br/><h3>Welcome </h3><br/><h2 style="font-family:sans-serif;font-size: 40px;color:#33CCCC"><?php  echo $names[0];?></h2>
<div id="instructions" style="font-family:20px;">
<center>
<a href="#listofins" onclick="fun2()"><img src="images/clickhere.gif"/><h3>Instructions for the Examinations</h3></a>
</center>
</div>
<h1>select an exam from the list</a></h1></center>

<?php
$dep=$_SESSION['department'];
$rs=mysql_query("select * from exam_test where dept='$dep'");


echo "<table align=center id=display1 cellpadding=15px>";
echo "<tr><th>Category</th><th>Test name</th><th>Exam duration(mins)</th><th>No.of Questions</th><th>Exam date(Y-M-D)</th><th>Exam time</th><th>Status</th>";
while($row=mysql_fetch_row($rs))
{

	$issql="select * from registeredstudents where rollno='$ids' and examid='$row[0]'";
	$isres=mysql_query($issql);
	$isdata=mysql_num_rows($isres);
	if($isdata!=0)
	{
	$acttime=$row[5]." ".$row[6];
	$curtime=date("20y-m-d H:i:s");
	$totsec=$row[4]*60;
	$endtime=date("20y-m-d H:i:s",strtotime("+ $totsec seconds",strtotime($acttime)));
	$d=strtotime($curtime)-strtotime($acttime);
	$_SESSION['examendtime']=$endtime;
    if($d<=0)
    {
    	$actlink="return false";
    }
    else{
    	$actlink="return true";
    }
    $d2=strtotime($curtime)-strtotime($endtime);

	$statussql="select * from `results` where rollno='$ids' and test_id='$row[0]'";
	$statusresult=mysql_query($statussql);
	$statusdata=mysql_fetch_row($statusresult);
	if(mysql_num_rows($statusresult)<1)
	{

		$statusmsg='Take test';
		$statuslink='cookieops.php';

	}
	else
	{

		$statusmsg='View results';
		$statuslink='viewresults.php';

	}
	if($d2>0)
	{
		$statusmsg='view results';
		$statuslink='viewresults.php';
	}
	echo "<tr align=center><td align=center >$row[1]</td><td><a id=fwdlink href=$statuslink?tid=$row[0] onclick='$actlink'><font size=4>$row[2]</td><td>$row[4]</td><td>$row[3]</td><td>$row[5]</td><td>$row[6]</td><td><a id=fwdlink href=$statuslink?tid=$row[0] onclick='$actlink'>$statusmsg</a></td></font></a>";
	


}
}
echo "</table></table>";

?>

<div id="uoptions">
<table align="center">
<!--<tr ><a href="dashboard.php">Dashboard</a></tr></table>-->
<tr ><a href="logout.php">Logout</a></tr></table>
</div>

<div id="listofins">
	<center>
<table id="instable">
		<tr colspan=2>
			<td><font color="black">Examination Rules: </font></td>
		</tr>
		<tr colspan=2>
			<td>1.Exam link will activate only after the starting time of the exam</td>
		</tr>
		<tr colspan=2>
			<td>2.Timer will run once examination starts and a maximum late of 5 mins is accepted</td>
		</tr>
		<tr colspan=2>
			<td>3.You are been monitered in the moniter system and you should only login to your rollnumber else your id will be locked</td>
		</tr>
		<tr colspan=2>
			<td>4.your session will be locked if you close the browser or if you attempt to open other websites in the session</td>
		</tr>
		<tr colspan=2>
			<td>5.Dont click refresh or back buttons in your browser</td>
		</tr>
		<tr colspan=2>
			<td>5.Click on FINISH EXAM button after you complete the exam and you are redirected to feedback page</td>
		</tr>
		<tr colspan=2>
			<td>6.After feedback page you can see your results</td>
		</tr>
		<tr colspan=2>
			<td>7.Exam will automatically finished after the completion of maximum time</td>
		</tr>
		<tr colspan=2>
			<td>8.Student ID will be cancelled if any copying or malpracting is done at the time of examination</td>
		</tr>
		<tr colspan=9>
			<td>9.Students are not allowed to use any electronic gadgets like mobile phones, calculators etc.</td>
		</tr>
<tr><br/></tr>
<tr><br/></tr>
                <tr colspan=2>
			<td><font color="black">Online exam information:</font></td>
		</tr>
		<tr colspan=2>
			<td>1.The White Buttons in the exam interface show unattempted questions</td>
		</tr>
		<tr colspan=2>
			<td>2.The <font color="green">Green</font> Buttons show attempted questions</td>
		</tr>
		<tr colspan=2>
			<td>3.The <font color="orange">Orange</font> Buttons show reviewed questions</td>
		</tr>
		<tr colspan=2>
			<td>4.The timer will be displayed on the top-right most of the window</td>
		</tr>
		<tr colspan=2>
			<td>5.Calculator is also provided for calculations and you are not allowed to use your cellularphones and calculators</td>
		</tr>
		<tr colspan=2>
			<td>6.The exam does not contain negative marks and the cutoff pass percentage is 40% of total marks</td>
		</tr>
		<tr colspan=2>
			<td>7.If you face any technical errors contact your exam invigilators</td>
		</tr>
		<tr colspan=2>
			<td>8.Incase of power failure/system failure/technical problems contact your invigilator for freezing of your timer</td>
		</tr>
		<tr colspan=2>
			<td><a href="#header" onclick="fun3()"><h3>Go to top</h3></a></td>
		</tr>
	</table>
</center>
</div>








</body>
</html>