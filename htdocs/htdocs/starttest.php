<?php
session_start();
error_reporting(1);
date_default_timezone_set('Asia/Kolkata');
include("connection.php");
$stu=$_SESSION['loginrollno'];
$exid=$_SESSION['tid'];
$_SESSION['examorgid']=$exid;
$sql="select * from exam_timer where userid='$stu' and testid='$exid'";
$res=mysql_query($sql);
if(mysql_num_rows($res)<1)
{
$getsql="select * from exam_test where test_id='$exid'";
$getres=mysql_query($getsql);
$examdata=mysql_fetch_row($getres);
$cachetime=$examdata[5]." ".$examdata[6];
$actstarttime=strtotime($cachetime);
$maxallowtime=strtotime("+600 seconds",$actstarttime);
$curtime2=date("20y-m-d H:i:s");
$curtime=strtotime($curtime2);

$diff=$curtime-$maxallowtime;

if($diff>=0)
{
$realtime=$maxallowtime;
}
else
{
$realtime=$curtime;
}


$cutoff=$examdata[4]*60;


$userendtime=date("20y-m-d H:i:s",strtotime("+ $cutoff seconds",$realtime));
$actendtime=$_SESSION['examendtime'];

$sql2="insert into exam_timer(userid,testid,sttime,endtime,status) values('$stu','$exid','$curtime2','$userendtime','Unlocked')";
$res2=mysql_query($sql2);
$ip=$_SERVER['REMOTE_ADDR'];
$sql3="update registeredstudents set status='running',logging='$ip' where rollno='$stu' and examid='$exid'";
$res3=mysql_query($sql3);
header("location:interface.php");
}
else
{
header("location:interface.php");
}

?>