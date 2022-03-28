<?php
session_start();
error_reporting(1);
include('db.php');
$deptname=$_SESSION['dept'];
?>
<html>
<head>
<link rel="stylesheet" href="../css/style2.css"/>
<title>add Moniters</title>
<style>
form{
    color:#808000;
    font-family:sans-serif;
    font-size:25px;
}
</style>
<SCRIPT LANGUAGE="JavaScript">
function check() {
mt=document.form1.uid.value;
if(mt.length<1){
alert("please enter valid username");
document.form1.subid.focus();
return false;
}
mt=document.form1.pwd.value;
mt1=document.form1.rpwd.value;
if (mt.length<1 || mt1.length<1 || mt!=mt1 ) {
alert("Password is invalid or password didn't matched");
document.form1.subname.focus();
return false;
}
return true;
}
</script>

</head>
<body>
<img src="../images/header2.png"/>
<div id="options">
<center>
<ul>
<li><a href="admin.php">Home</a></li>
<li><a href="signout.php">Signout</a></li>
</ul>
</center></div>





<div style="text-align:left">



<?php
extract($_POST);
echo "<BR><br/><br/>";
echo "<center><br/><h3 id=head2 >Add Exam Invigilators Credentials</h3></center>";

echo "<table width=100%>";
echo "<tr><td align=center></table>";
if(isset($submit))
{
$exid=$_POST['teid'];
$rs=mysql_query("select * from exam_moniters where exam_id='$teid' and userid='$uid' and password='$pwd'");
if (mysql_num_rows($rs)>0)
{
	echo "<br><br><br><div class=head1>User Already Exists</div>";
	exit;
}
mysql_query("insert into exam_moniters(exam_id,userid,password,dept,status) values ('$teid','$uid','$pwd','$deptname','not completed')") or die(mysql_error());
echo "<p align=center>User  <b> \"$uid \"</b> Added Successfully.</p>";
$submit="";
}
?>
<?php
$selsql="select test_id,test_name from exam_test where dept='$deptname'";
$selres=mysql_query($selsql);
?>
<form name="form1" method="post" onSubmit="return check();">
  
  <table width="41%"  border="0" align="center">
  <tr>
  <td width="45%" height="32"><div align="center"><strong>Select an Exam</strong></div></td>
  <td width="2%" height="5">
  <td width="53%" height="32"><select name="teid" id="teid">
  <?php
  while($data=mysql_fetch_row($selres))
  { 
  echo "<option value=$data[0]>".$data[1]."</option>";
  }
  ?>
  </select></td>
  </tr>
  <tr>
      <td width="45%" height="32"><div align="center"><strong>Enter Username</strong></div></td>
      <td width="2%" height="5">  
      <td width="53%" height="32">
        <input name="uid" placeholder="enter username" type="text" id="uid">
    <tr>
      <td width="45%" height="32"><div align="center"><strong>Enter Password</strong></div></td>
      <td width="2%" height="5">  
      <td width="53%" height="32">
      <input name="pwd" placeholder="enter password" type="password" id="pwd">
  </tr>
  <tr>
      <td width="45%" height="32"><div align="center"><strong>Re-enter Password</strong></div></td>
      <td width="2%" height="5">  
      <td width="53%" height="32">
      <input name="rpwd" placeholder="re-enter password" type="password" id="rpwd">
  </tr>
    <tr>
        <td height="26"> </td>
        <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="26"></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Add" ></td>
    </tr>
  </table>
</form>
<p>&nbsp; </p>
</div>
</body>
</html>