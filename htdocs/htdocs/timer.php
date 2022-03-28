<?php
session_start();
include("connection.php");
$testerid=$_SESSION['loginrollno'];
$examtimerid=$_SESSION['tid'];

$sqlst="select endtime from exam_timer where userid='$testerid' and testid='$examtimerid' ";
$sqlres=mysql_query($sqlst);
$sqltimerdata=mysql_fetch_array($sqlres);
date_default_timezone_set('Asia/Kolkata');
$cur1=date("20y-m-d H:i:s");
$d12=strtotime($sqltimerdata[0])-strtotime($cur1);
$_SESSION['timer']=$d12;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Countdown Examples 2</title>
<script src="countdown.js" type="text/javascript"></script>

</head>
<body style="background-color:#EDEDED">

<script type="application/javascript">
var myCountdown2 = new Countdown({
									time:<?php echo $_SESSION['timer']; ?>, 
									width:150, 
									height:80, 
									onComplete:countdownComplete,
									rangeHi:"minute"	// <- no comma on last item!
									});
function countdownComplete(){
	alert("Sorry! your time is completed..");
	window.location="generateresults.php";
}


</script>




<p id="areas">
</p>
</body>
</html>