<html>
<head><link rel="stylesheet" href="../css/style2.css"/>
<style>
body
{
  font-size: 20px;
  font-family: sans-serif;
  color: 
}
</style>
</head>
<body>
<font color="blue">Upload Log:</font>
<br/><br/>
<center>
<?php
  session_start();

 if(isset($_POST['submit']))
 {
  include 'db.php';
  require_once 'Classes/excel_reader.php';
  $examid=$_POST['uploadexamid'];
  $file1 = $_FILES['file']['tmp_name'];
  $data = new Spreadsheet_Excel_Reader($file1);
  $sheet = $data->sheets[0];
  $rows = $sheet['cells'];
  $rowCount = count($rows);
  $i=1;
  while($i<=$rowCount)
  {
    $stuid = $data->val($i,1);
    $tessql="select * from registeredstudents where examid='$examid' and rollno='$stuid'";
    $tesres=mysql_query($tessql);
    if(mysql_num_rows($tesres)<1)
    {
    $sql = "insert into registeredstudents values ('$examid','$stuid','','incomplete')";
    mysql_query($sql);
    echo $stuid."&nbsp&nbspis successfully added to list<br/>";
    }
    else
    {
     echo $stuid."&nbsp&nbspis already present in list with same exam id... <br/>"; 
    }
    $i++;
  }
  echo "<br/><br/><font color=blue>you have uploaded data to the &nbsp".$examid."&nbsp exam</font><br/>";
  echo "<font color=green>total Records found with the above exam is&nbsp".($i-1)."</font><br/>";
 }
?>
</center>
<font color=red>If there is any mismatch in the number of students then re-upload file without errors and if still problem persists then contact Database Administrator</font>
<div id="options">
<center>
<ul>
<li><a href="admin.php">Home</a></li>
<!-- <li><a href="delstudata.php">Modify Student Data</a></li> -->
</ul>
</center></div>
</body>
</html>