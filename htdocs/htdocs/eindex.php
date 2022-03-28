<?php
session_start();
mysql_connect("localhost","jntuacep_oes","jntuacep");
mysql_select_db("jntuacep_oes");
extract($_POST);
if(isset($_SESSION['loginrollno']))
{
	$_SESSION['loginrollno']='';
}
if(isset($_POST['submit']))
{
    $loginid=$_POST['login'];
    $pass=$_POST['password'];
    error_reporting(E_ERROR || E_PARSE);
    $rs=mysql_query("select * from students where id='$loginid' and password='$pass'");
	if(($res=mysql_num_rows($rs))<1)
	{  
		$found="n";
	}
	else
	{
		$_SESSION['loginrollno']=$loginid;
        $_SESSION['orgpwd']=$pass;
        header("location:exam.php");
	}    
}

?>
<!DOCTYPE html>
<html>
	
<head>
<title>JNTUACEP | online exam system</title>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<script type="application/x-javascript"> 
addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
function myFunction(){

  
}
function myFunction2() { 
     if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) 
    {
        alert('you opened the portal in OPERA browser..kindly open in CHROME browser');
        return false;
    }
    else if(navigator.userAgent.indexOf("Chrome") != -1 )
    {
        //alert('Chrome');
    }
    else if(navigator.userAgent.indexOf("Safari") != -1)
    {
        alert('you opened the portal in SAFARI browser..kindly open in CHROME browser');
    	return false;
	}
    else if(navigator.userAgent.indexOf("Firefox") != -1 ) 
    {
         alert('you opened the portal in FIREFOX browser..kindly open in CHROME browser');
         return false;
    }
    else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
    {
      alert('you opened the portal in Inernet Explorer..kindly open in CHROME browser'); 
      return false;
    }  
    else 
    {
       alert('your browser is not recognised..kindly open in CHROME browser');
    	return false;
    }
    }
 </script>
 <noscript><meta http-equiv="refresh" content="1;url=errornojs.html"></noscript>

<style>
#message
{
	position:absolute;
	top:90%;
}
</style>
<!--webfonts-->
        <link href='http://fonts.googleapis.com/css?family=Orbitron:700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic|Oswald:400,300,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,700,800' rel='stylesheet' type='text/css'>
<!--//webfonts-->
</head>
<body>
	<div id="header_title">
    <center>
    <span id="maintitle"><h1>Online Examination System</h1></span>
    <h3>JNTUA College of Engineering,Pulivendula</h3>
    </center>
    </div>

	<div class="login-04">
		<div class="fourth-login">
			<form class="four" action="" method="post">
				<div class="green">
					<input type="text" name="login" id="login" class="text" value="USERNAME" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'USERNAME';}" >
				</div>
				<div class="block">
					<input type="password" name="password" id="password" value="PASSWORD" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'PASSWORD';}" > 
				</div>
					<input type="submit" name="submit" onclick="return myFunction2()" value="LOG IN" > 
                    
			</form>
           
		</div>
        
	</div>
    
     <span id="error">
     <?php
     if(isset($found))
     {
     echo("*check your creditinals once");
     }
     ?>
     </span>
</body>
</html>