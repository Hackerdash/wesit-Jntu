<?php
session_start();
error_reporting(1);
$deptname=$_SESSION['dept'];
/*if (!isset($_SESSION['alogin']))
{
	echo "<br><h2>You are not Logged On Please Login to Access this Page</h2>";
	echo "<a href=index.php><h3 align=center>Click Here for Login</h3></a>";
	exit();
}*/
?>
<link href="../css/style2.css" rel="stylesheet" type="text/css">
<style>
form{
    font-family: sans-serif;
    font-size:28px;
}

p{
    color:black;
    position: absolute;
    top:36%;
    left:37%;
}
</style>

<SCRIPT LANGUAGE="JavaScript">
function check() {
mt=document.form1.testname.value;
if (mt.length<1) {
alert("Please Enter Test Name");
document.form1.testname.focus();
return false;
}
tt=document.form1.totque.value;
if(tt.length<1 || isNaN(tt)) {
alert("Please Enter Total Question/enter integer");
document.form1.totque.focus();
return false;
}
tott=document.form1.tottime.value;
if(tott.lenght<1 || isNaN(tott)){
    alert("please Enter Total Time");
    document.form1.tottime.focus();
    return false;
}

return true;
}
</script>
<body>
<img src="../images/header2.png"/>
<div id="options">
<center>
<ul>
<li><a href="admin.php">Home</a></li>
<li><a href="signout.php">Signout</a></li>
</ul>
</center></div>
<center><h2 id="head3">Add an Exam </h2></center>

<?php
require("../connection.php");
include "db.php";
//echo "<br><h2><div  class=head1>Add an exam</div></h2>";
if($_POST[submit]=='Save' || strlen($_POST['subid'])>0 )
{
    extract($_POST);
$totque=(int)$totque;
$tottime=(int)$tottime;
$a=substr($doe,5,9);
$testid=substr($deptname,0,2).substr($subid,0,2).$a.'_'.(string)$totque.(string)$tottime;
$rs=mysql_query("select * from exam_test where test_id='$testid' and test_name='$testname' and dept='$deptname'");
if (mysql_num_rows($rs)>0)
{
	echo "<br><br><br><div class=head1>Test is Already Exists..choose another exam</div>";
	exit;
}
$ct=$_POST['coursetype'];
$yt=$_POST['yeartype'];
mysql_query("insert into exam_test(test_id,sub_id,test_name,total_que,total_time,dateofexam,start_time,dept,ctype,year) values ('$testid','$subid','$testname','$totque','$tottime','$doe','$sttime','$deptname','$ct','$yt')") or die(mysql_error());
echo "<p align=center>Test <b>\"$testname\"</b> Added Successfully.</p>";
unset($_POST);
//header("location:admin.php");
}
?>


<form name="form1" id="form1" method="post" onSubmit="return check();">
  <table width="58%"  border="0" align="center">
    <tr>
      <td width="49%" height="32"><div align="left"><strong>Enter Subject ID </strong></div></td>
      <td width="3%" height="5">  
      <td width="48%" height="32"><select name="subid">
<?php
$rs=mysql_query("Select * from exam_subject where dept='$deptname' order by subject");
	  while($row=mysql_fetch_array($rs))
{
if($row[0]==$subid)
{
echo "<option value='$row[0]' selected>$row[1]</option>";
}
else
{
echo "<option value='$row[0]'>$row[1]</option>";
}
}
?>
      </select>
        
    <tr>
        <td height="26"><div align="left"><strong> Enter Test Name </strong></div></td>
        <td>&nbsp;</td>
	  <td><input name="testname" type="text" id="testname"></td>
    </tr>
    <tr>
      <td height="26"><div align="left"><strong>Enter Total Question </strong></div></td>
      <td>&nbsp;</td>
      <td><input name="totque" type="text" id="totque"></td>
    </tr>
     <tr>
      <td height="26"><div align="left"><strong>Enter Total time(in mins) </strong></div></td>
      <td>&nbsp;</td>
      <td><input name="tottime" type="text" id="tottime"></td>
    </tr>
      <tr>
      <td height="26"><div align="left"><strong>Select Date of Exam </strong></div></td>
      <td>&nbsp;</td>
      <td><input name="doe" type="date" id="doe"></td>
    </tr>
      <tr>
      <td height="26"><div align="left"><strong>Enter starting time(HH:MM:SS[24hr format]) </strong></div></td>
      <td>&nbsp;</td>
      <td><input name="sttime" type="text" id="sttime"></td>
    </tr>
      <tr>
      <td height="26"><div align="left"><strong>Select course type</strong></div></td>
      <td>&nbsp;</td>
      <td><select name="coursetype" id="coursetype"><option selected>B.Tech</option><option>M.Tech</option></select></td>
    </tr>  <tr>
      <td height="26"><div align="left"><strong>Select year </strong></div></td>
      <td>&nbsp;</td>
      <td><select name="yeartype" id="yeartype"><option>1</option><option>2</option><option selected>3</option><option>4</option></select></td>
    </tr>

    <tr>
      <td height="26"></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="Add" ></td>
    </tr>
  </table>
</form>
<p>&nbsp; </p>
</body>