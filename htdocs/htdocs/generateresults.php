<?php
session_start();
include("connection.php");

$rid=$_SESSION['loginrollno'];
$eid=$_SESSION['tid'];
$sql="select * from exam_session where userid='$rid' and examid='$eid'";
$res=mysql_query($sql);
$totalmarks=0;
$corr=0;
$wrong=0;
$unattem=0;
$total=0;
while($data=mysql_fetch_array($res))
{
$co=trim($data[4]);
$us=trim($data[5]);
if($data[5]==null)
{
	$unattem++;
	$total=$total+$data[6];
}

else if($co==$us)
{
	
	$corr++;
	$totalmarks=$totalmarks+$data[6];
	$total=$total+$data[6];
}
else
{
	$wrong++;
	$totalmarks=$totalmarks+($data[7]);
	$total=$total+$data[6];
}
}
$sql2="insert into results(test_id,rollno,marks,correct,wrong,unattempt,totalmarks) values('$eid','$rid',$totalmarks,'$corr','$wrong','$unattem','$total')";
$res=mysql_query($sql2);
$sql3="update registeredstudents set status='completed' where rollno='$rid' and examid='$eid'";
$res2=mysql_query($sql3);
header("location:feedback.php");

?>

