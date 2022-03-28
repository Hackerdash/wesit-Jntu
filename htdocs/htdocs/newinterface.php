<?php
session_start();
error_reporting(E_PARSE);
date_default_timezone_set('Asia/Kolkata');
include("connection.php");
$testid=$_SESSION['tid'];
$sturoll=$_SESSION['loginrollno'];
//session check starting
include("interfacesupp.php");
//end of session checking
//question submission


if(isset($_POST['submitanswer']))
{
  $qu=$_SESSION['curq'];
  if(isset($_POST['answer']))
  {
  $uans=$_POST['answer'];
  mysql_query("update exam_session set user='$uans',status='a' where examid='$testid' and userid='$sturoll' and maskno='$qu'");
  $_SESSION['curq']=$qu++;
  $_POST['answer']='';
  }
  else{
      	echo "<script>alert('please select an option!');</script>";
      	$_SESSION['curq']=$qu;
    }  

}

if(isset($_POST['reset']))
{
  $uans='';
  $qu=$_SESSION['curq'];
  mysql_query("update exam_session set user='$uans',status='na' where examid='$testid' and userid='$sturoll' and maskno='$qu'");
  $_SESSION['curq']=$qu++;
  $_POST['answer']='';
}
if(isset($_POST['review']))
{
  $uans=$_POST['answer'];
  $qu=$_SESSION['curq'];
  mysql_query("update exam_session set user='$uans',status='ar' where examid='$testid' and userid='$sturoll' and maskno='$qu'");
  $_SESSION['curq']=$qu++;
  $_POST['answer']='';
}


?>

<html>
<head>
	<title>Exam Interface</title>
	<link href="css/exam.css" rel="stylesheet"/>
	<link href="css/calcy.css" rel="stylesheet"/>
	<link href="js/calcy.js" rel="stylesheet"/>
	<link href="css/interface.css" rel="stylesheet"/>
	<script language=JavaScript> var message="Function Disabled!"; function clickIE4(){ if (event.button==2){ alert(message); return false; } } function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ alert(message); return false; } } } if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; } document.oncontextmenu=new Function("alert(message);return false") </script>
	<noscript><meta http-equiv="refresh" content="1;url=errornojs.html"></noscript>
<script>
function confirmfinish()
{
	var x=confirm("Are you sure to finish ?");
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
</head>
<body bgcolor="white" ondragstart="return false" onselectstart="return false" >
<?php
include("header.php");
?>





<?php
include 'calcy.php';
?>
</body>