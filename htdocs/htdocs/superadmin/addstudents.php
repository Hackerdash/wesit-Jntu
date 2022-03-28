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
		<title>UPLOAD Students details </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	

		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">
        <link rel="stylesheet" href="../css/style2.css"/>

	</head>
	<body>   
<center><h2>Upload Students Data (in .Xls Format[ms excel 97-2003 format])</h2></center> 
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
								<label>Select Test Category</label>
							</div>
							<div class="controls">
								<?php
								echo "<select name='uploadexamcat'>";
                                $sqlstmt2 = "SELECT `sub_id` FROM `exam_test` WHERE `dept`='$deptname'";
                                $result2=mysql_query($sqlstmt2);
                                while($row2=mysql_fetch_array($result2))
                                {

                                echo "<option value=$row2[0]>$row2[0]</option>";
                                }
                                echo "</select>";
                                ?>
                                
                               
                                <input type="submit" value="show tests" name="subcat" id="subcat">
							</div>
</form>


				<form class="form-horizontal well" action="uploadstudata.php" method="post" name="upload_excel" enctype="multipart/form-data">
					<fieldset>
						<legend>Import Eligible Students file</legend>
                        
                      
						
							<div class="control-label">
								<label>Select Test name</label>
							</div>
							<div class="controls">
								<select name="uploadexamid">
                                <?php
                                var_dump($_POST['uploadexamcat']);
                                if(isset($_POST['subcat']))
                                {
                                	$cate=$_POST['uploadexamcat'];
                                $sqlstmt = "SELECT `test_id`,`test_name` FROM `exam_test` where `sub_id`='$cate'";
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
                        
                        
                        
							<div class="control-label">
								<label>CSV/Excel File:</label>
							</div>
							<div class="controls">
								<input type="file" name="file" id="file" class="input-large">
							</div>
						</div>
						
						<div class="control-group">
							<div class="controls">
							<button type="submit" id="submit" name="submit" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="span3 hidden-phone"></div>
		</div>
		

		<table class="table table-bordered">
			<thead>
				  	<tr>
				  		
                        <th>Student ID</th>
				 
				  	</tr>	
				  </thead>
		
		</table>
	</div>

	</div>
	</body>
</html>