<?php
session_start();

error_reporting(E_PARSE || E_FETCH);
$deptname=$_SESSION['dept'];
?>
<!DOCTYPE html>
<?php 
	include 'db.php';
	

?>	
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>UPLOAD EXCEL </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	

		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">
        <link rel="stylesheet" href="../css/style2.css"/>

	</head>
	<body>   
<center><h2>RESULTS | Online Examination System</h2></center> 
<div id="options">
<center>
<ul>
<li><a href="admin.php">Home</a></li>
<li><a href="signout.php">Signout</a></li>
</ul>
</center></div>

	<div id="wrap">
	<div class="container">
		<div class="row">
 
			<div class="span3 hidden-phone"></div>
			<div class="span6" id="form-login">
   <form action="" method="POST">         
<div class="control-group">
							<div class="control-label">
								<label>Select Department</label>
							</div>
							<div class="controls">
								<select name="uploadexamcat">
                                <?php
                                $sqlstmt2 = "SELECT DISTINCT `dept` FROM `exam_test`";
                                $result2=mysql_query($sqlstmt2);
                                while($row2=mysql_fetch_array($result2))
                                {
                                echo "<option value=$row2[0]>$row2[0]</option>";
                                }

                                ?>
                                
                                </select>
                               
                                <input type="submit" value="show tests" name="subcat" id="subcat">
							</div>
</form>


				<form class="form-horizontal well" action="dispresults.php" method="post" name="upload_excel">
					<fieldset>
						<legend>Select an exam to generate results</legend>
                        
                      
						
							<div class="control-label">
								<label>Select Test name</label>
							</div>
							<div class="controls">
								<select name="examid">
                                <?php
                                //var_dump($_POST['uploadexamcat']);
                                if(isset($_POST['subcat']))
                                {
                                	$cate=$_POST['uploadexamcat'];
                                	$_SESSION['dept']=$cate;
                                $sqlstmt = "SELECT `test_id`,`test_name` FROM `exam_test` where `dept`='$cate'";
                                $result=mysql_query($sqlstmt);
                                while($row=mysql_fetch_array($result))
                                {
                                echo "<option value=$row[0]>$row[1]</option>";
                                }
                                $_SESSION['uploadexamcat']=$cate;
                                }
                                ?>
                                
                                </select>
                                
							</div>
                        
						</div>
						
						<div class="control-group">
							<div class="controls">
							<button type="submit" id="submit" name="submit" class="btn btn-primary button-loading" data-loading-text="Loading...">Generate Results</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="span3 hidden-phone"></div>
		</div>
		


	</div>

	</div>
	</body>
</html>