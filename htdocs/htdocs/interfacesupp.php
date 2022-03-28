<?php
session_start();
error_reporting(E_PARSE);
include("connection.php");
$testid=$_SESSION['tid'];
$sturoll=$_SESSION['loginrollno'];
if($sturoll=='')
{
	header("Location:index.php");
}
//session checking from database
$checkres=mysql_query("select * from results where test_id='$testid' and rollno='$sturoll'");
if(mysql_num_rows($checkres)>0)
{
	header("Location:index.php");
}
//lock status of student
$locksql1=mysql_query("select status from registeredstudents where examid='$testid' and rollno='$sturoll'");
$lockdata=mysql_fetch_row($locksql1);
if($lockdata[0]=='locked')
{
	header("Location:lockscreen.php");
}
elseif($lockscreen[0]=='completed')
{
	header("Location:index.php");
}
//end of lock status
$sessionsql="select * from exam_session where examid='$testid' and userid='$sturoll'";
$sessionresult=mysql_query($sessionsql);
if(mysql_num_rows($sessionresult)==0)
{
$updsessql="select * from exam_question where test_id='$testid' order by RAND()";
$updsesresult=mysql_query($updsessql);
$i=1;
while($updsesdata=mysql_fetch_array($updsesresult))
{
$insres=mysql_query("insert into exam_session(userid,examid,maskno,qno,correct,user,posmarks,negmarks,status) values ('$sturoll','$testid',$i,$updsesdata[2],'$updsesdata[8]','',$updsesdata[9],$updsesdata[10],'na')");
$i++;
}
}
else
{

}
?>