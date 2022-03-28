<?php
session_start();
error_reporting(1);
include('db.php');
$deptname=$_SESSION['dept'];
?>
<html>
<head>
<link rel="stylesheet" href="../css/style2.css"/>
<title>add category</title>
<style>
form{
    color:#808000;
    font-family:sans-serif;
    font-size:25px;
}
</style>
<SCRIPT LANGUAGE="JavaScript">
function check() {
mt=document.form1.subid.value;
if(mt.length<1){
alert("please enter valid category id");
document.form1.subid.focus();
return false;
}
mt=document.form1.subname.value;
if (mt.length<1) {
alert("Please Enter Subject Name");
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
<center>
<div id="viewsubs">

</div>
</center>





<div style="text-align:left">















<?php
extract($_POST);
echo "<BR><br/><br/>";
echo "<center><br/><h3 id=head2 >Add a category or subject</h3></center>";

echo "<table width=100%>";
echo "<tr><td align=center></table>";
if($submit=='submit' || strlen($subname)>0 ||strlen($subid)>0 )
{
$rs=mysql_query("select * from exam_subject where subject='$subname' or sub_id='$subid'");
if (mysql_num_rows($rs)>0)
{
	echo "<br><br><br><div class=head1>Subject is Already Exists</div>";
	exit;
}
mysql_query("insert into exam_subject(sub_id,subject,dept) values ('$subid','$subname','$deptname')") or die(mysql_error());
echo "<p align=center>Subject  <b> \"$subname \"</b> Added Successfully.</p>";
$submit="";
}
?>
<?php
$selsql="select sub_id,subject from exam_subject where dept='$deptname'";
$selres=mysql_query($selsql);
?>
<form name="form1" method="post" onSubmit="return check();">
  
  <table width="41%"  border="0" align="center">
  <tr>
  <td width="45%" height="32"><div align="center"><strong>View Subjects</strong></div></td>
  <td width="2%" height="5">
  <td width="53%" height="32"><select>
  <?php
  while($data=mysql_fetch_row($selres))
  { 
  echo "<option>".$data[0]."&nbsp&nbsp".$data[1]."</option>";
  }
  ?>
  </select></td>
  </tr>
  <tr>
      <td width="45%" height="32"><div align="center"><strong>Enter category Code </strong></div></td>
      <td width="2%" height="5">  
      <td width="53%" height="32">
        <input name="subid" placeholder="enter category code" type="text" id="subid">
    <tr>
      <td width="45%" height="32"><div align="center"><strong>Enter Category</strong></div></td>
      <td width="2%" height="5">  
      <td width="53%" height="32">
        <input name="subname" placeholder="enter language name" type="text" id="subname">
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