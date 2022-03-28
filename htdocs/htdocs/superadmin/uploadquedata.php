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
<font color=black>Note:The questions will be displayed in the main exam as they are displayed now..so if you found any changes in question or format then click on re-upload the file..if no error found then click on 'proceed' </font>
<br/><br/>
<font color="blue">Upload Log:</font>
<br/><br/>
<center>
<?php
  session_start();

error_reporting(E_PARSE || E_FETCH);
$cname=$_SESSION["uploadexamcat"];
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
  echo "<table width=90% border=1px style=border-collapse:collapse;>";
  $countques=0;
  for($i=1;$i<=$rowCount;$i++)
  {
    $qno = $data->val($i,1);
    $ques = $data->val($i,2);
    $o1=$data->val($i,3);
    $o2=$data->val($i,4);
    $o3=$data->val($i,5);
    $o4=$data->val($i,6);
    $to=$data->val($i,7);
    $pm=$data->val($i,8);
    $nm=0;//default value ..if exam need negative marks replace 0 with $data->val($i,9)
    $tessql="select * from exam_quescache where examid='$examid'";
    $tesres=mysql_query($tessql);
    $tesdata=mysql_fetch_row($tesres);
    if(mysql_num_rows($tesdata)>0)
    {
      $delsql="delete * from exam_quescache where test_id='$examid'";
      mysql_query($delsql);
  
    }
    $sql = "insert into exam_quescache values ('$examid','$cname',$qno,'$ques','$o1','$o2','$o3','$o4','$to',$pm,$nm)";
    mysql_query($sql);
    echo "<tr style=background-color:#ccc;><td>".$qno."</td><td colspan=3>".$ques."</td></tr><tr style=background-color:#FFBBFF><td>".$o1."</td><td>".$o2."</td><td>".$o3."</td><td>".$o4."</td></tr><tr><td colspan=2>".$to."</td><td>".$pm."</td><td>".$nm."</td></tr>";
    echo "<tr style=background-color:#000;><td></td><td></td><td></td><td></td></tr>";
    $countques++;
    }
  echo "</table>";
  echo "<br/><br/><font color=blue>you have uploaded questions to the &nbsp".$examid."&nbsp exam</font><br/>";
  echo "<font color=green>total number of questions found with the above exam is&nbsp".$countques."</font><br/><br/>";
 }
echo "<a href='proceedupload.php?testid=$examid'>Proceed</a><br/>";
echo "<a href='reuploadques.php?testid=$examid'>Re-upload File</a><br/><br/>";
?>
</center>
<font color=red>If there is any mismatch in the number of questions you uploaded with actual number of questions then re-upload file without errors and if still problem persists then contact Database Administrator</font>

<div id="options">
<center>
<ul>
<li><a href="admin.php">Home</a></li>
<li><a href="delstudata.php">Modify Student Data</a></li>
</ul>
</center></div>
</body>
</html>