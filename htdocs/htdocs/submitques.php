<?php
session_start();
include("connection.php");
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
unset($_POST['submitanswer']);
unset($_POST['reset']);
unset($_POST['answer']);
unset($_POST['review']);
header("Location:interface.php");
?>