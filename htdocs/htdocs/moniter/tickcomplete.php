<?php
include 'db.php';
error_reporting(E_PARSE||E_FETCH);
date_default_timezone_set('Asia/Kolkata');
$did=$_SESSION['dept'];
$eid=$_SESSION['testid'];
$abssql=mysql_query("select * from registeredstudents where examid='$eid' and status='running'");
while($absdata=mysql_fetch_row($abssql))
{
$curtime=strtotime(date("20y-m-d H:i:s"));
$gsql=mysql_query("select endtime from exam_timer where testid='$eid' and userid='$absdata[1]'");
$gdata=mysql_fetch_row($gsql);
$sttime=strtotime($gdata[0]);
$diff=($curtime-$sttime)/60;
if($diff>0.0)
{
	while($absdata=mysql_fetch_row($abssql))
	{
		if($absdata[3]=='incomplete')
		{
			$id=$absdata[1];
			$sql1=mysql_query("update registeredstudents set status='abse' where rollno='$id'");
			
		}
	}
}
?>