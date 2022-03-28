<?php
session_start();
error_reporting(E_PARSE);
date_default_timezone_set('Asia/Kolkata');
include("connection.php");
include("disablekeys.php");
$testid=$_SESSION['tid'];
$sturoll=$_SESSION['loginrollno'];
//session check starting
//include("interfacesupp.php");









if($sturoll=='')
{
	header("Location:index.php");
}
//session checking from database
$checkres=mysql_query("select * from results where test_id='$testid' and rollno='$sturoll'");
if(mysql_num_rows($checkres)>0)
{
	header("Location:index.php");
}
//lock status of student
$locksql1=mysql_query("select status from registeredstudents where examid='$testid' and rollno='$sturoll'");
$lockdata=mysql_fetch_row($locksql1);
if($lockdata[0]=='locked')
{
	header("Location:lockscreen.php");
}
elseif($lockscreen[0]=='completed')
{
	header("Location:index.php");
}
//end of lock status
$sessionsql="select * from exam_session where examid='$testid' and userid='$sturoll'";
$sessionresult=mysql_query($sessionsql);
if(mysql_num_rows($sessionresult)==0)
{
$updsessql="select * from exam_question where test_id='$testid' order by RAND()";
$updsesresult=mysql_query($updsessql);
$i=1;
while($updsesdata=mysql_fetch_array($updsesresult))
{
$insres=mysql_query("insert into exam_session(userid,examid,maskno,qno,correct,user,posmarks,negmarks,status) values ('$sturoll','$testid',$i,$updsesdata[2],'$updsesdata[8]','',$updsesdata[10],$updsesdata[11],'na')");
$i++;
}
}
else
{

}




















//end of session checking
//question submission
if(isset($_POST['submitanswer']))
{
  $qu=$_SESSION['curq'];
  if($_POST['answer']!='')
  {
  $uans=$_POST['answer'];
  mysql_query("update exam_session set user='$uans',status='a' where examid='$testid' and userid='$sturoll' and maskno='$qu'");
  $_SESSION['curq']=$qu++;
  $_POST['answer']='';
  }
  else{
      	echo "<script>alert('please select an option!');</script>";
      	$_SESSION['curq']=$qu-1;
    }  

}

if(isset($_POST['reset']))
{
  $uans='';
  $qu=$_SESSION['curq'];
  mysql_query("update exam_session set user='$uans',status='na' where examid='$testid' and userid='$sturoll' and maskno='$qu'");
  $_SESSION['curq']=$qu++;
  $_POST['answer']='';
}
if(isset($_POST['review']))
{
  $uans=$_POST['answer'];
  $qu=$_SESSION['curq'];
  mysql_query("update exam_session set user='$uans',status='ar' where examid='$testid' and userid='$sturoll' and maskno='$qu'");
  $_SESSION['curq']=$qu++;
  $_POST['answer']='';
}
unset($_POST['submitanswer']);
unset($_POST['reset']);
unset($_POST['answer']);
unset($_POST['review']);










?>
<html>
<head>
	<title>Exam Interface</title>
	<link href="css/exam.css" rel="stylesheet"/>
	<link href="css/calcy.css" rel="stylesheet"/>
	<link href="js/calcy.js" rel="stylesheet"/>
	<link href="css/interface.css" rel="stylesheet"/>
	<script language=JavaScript> var message="Function Disabled!"; function clickIE4(){ if (event.button==2){ alert(message); return false; } } function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ alert(message); return false; } } } if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; } document.oncontextmenu=new Function("alert(message);return false") </script>
	<noscript><meta http-equiv="refresh" content="1;url=errornojs.html"></noscript>
<script>
function confirmfinish()
{
	var x=confirm("Are you sure to finish ?");
	if(x==true)
	{
		return true;

	}
	else
	{
		return false;
	}
}	
</script>

</head>
<body bgcolor="white" ondragstart="return false" onselectstart="return false" >
<?php
include("header.php");
?>
<div id="timerdisp">
<?php
echo "Time left";
include("timer.php");
?>
</div>
<div id="studetails">
<?php
echo("<font color=red>Welcome</font>");
echo "<br/>";
echo "".$_SESSION['loginrollno'];
echo "<br/>";
echo $_SESSION['stuname'];
$testid=$_SESSION['tid'];
?>
<br/>
<img src="students/<?php echo $_SESSION['loginrollno']; ?>.jpg"/>
</div>










<div id="queslist">
	<p>Questions</p>
	<form action="" method="POST">
	<?php 
	$sql1="select * from exam_session where examid='$testid' and userid='$sturoll'";
	$result1=mysql_query($sql1);
	$totalques=0;
	while($row=mysql_fetch_array($result1))
	{
	  $totalques++;
	  if($row[8]=="na")
	  { 	
	  	$bgcolor=white;
	  	$color=blue;
	 
	  }
	  else if($row[8]=='a')
	  {
	  	$bgcolor=green;
	  	$color=white;
	  }
	  else if($row[8]=='ar')
	  {
	  	$bgcolor=orange;
	  	$color=white;
	  }
	echo "<input type=submit style=background-color:$bgcolor;color:$color id=questions name=questions value=$totalques >";
	  
	}
	?>
	</form>
</div>


<div id="quesdisplay">
<form action="" method="POST">
<?php

if($_SESSION['curq']==null and $_POST['questions']==null)
{
	$quesno=1;
}
if(isset($_POST['questions']))
{
	$_SESSION['curq']=(int)$_POST['questions'];
	$quesno=(int)$_SESSION['curq'];

}
elseif($_SESSION['curq']!=null and $_SESSION['curq']<=$totalques)
{
	
	$quesno=(int)$_SESSION['curq'];
	$quesno++;
}
if($quesno>$totalques)
{
	$quesno=1;
}
$quesnum=$quesno;
$getqno=mysql_fetch_row(mysql_query("select qno,user,posmarks,negmarks from exam_session where userid='$sturoll' and examid='$testid' and  maskno='$quesnum'"));
$getq=mysql_query("select * from exam_question where qno='$getqno[0]' and test_id='$testid'");
$alldata=mysql_fetch_array($getq);

$ans=$getqno[1];
for($i=4;$i<8;$i++)
{
if($alldata[$i]==$ans)
{
$disptype[$i]="id=answer checked";
}
else
{
$disptype[$i]="id=answer";
}
}

echo "<font style='color:green;font-size:20px'><i>Positive Marks:&nbsp".$getqno[2]."</i>&nbsp</font>";
echo "<font style='color:red;font-size:20px'><i>Negative Marks:&nbsp".$getqno[3]."</i>&nbsp</font><br/><br/>";
echo "$quesnum . "."$alldata[3]"."<br/>";
if($alldata[9]=='Y'||$alldata[9]=='y')
{
echo "<img src=ques_images/$alldata[2].jpg alt='image missing' width=300 height=300/>";
}
echo "<table >";
echo "<tr><td>A . $alldata[4]</td><td>"."<input type=radio name=answer value='$alldata[4]' $disptype[4]></td></tr><tr>";
echo "<tr><td>B . $alldata[5]</td><td>"."<input type=radio name=answer value='$alldata[5]' $disptype[5]></td></tr><tr>";
echo "<tr><td>C . $alldata[6]</td><td>"."<input type=radio name=answer value='$alldata[6]' $disptype[6]></td></tr><tr>";
echo "<tr><td>D . $alldata[7]</td><td>"."<input type=radio name=answer value='$alldata[7]' $disptype[7]></td></tr><tr>";


echo "</table>";
$_SESSION['curq']=$quesnum;
?>


<input id="submitanswer" name="submitanswer" type="submit" value="submit answer">
<input id="reset" name="reset" type="submit" value="reset">
<input id="review" name="review" type="submit" value="mark for review">
</form>
</div>














<!--Starting of finish exam -->
<div id="testfin">
<?php
$finsql=mysql_query("select * from exam_timer where testid='$testid' and userid='$sturoll'");
$finishdata=mysql_fetch_row($finsql);
$curtime=strtotime(date("20y-m-d H:i:s"));
$sttime=strtotime($finishdata[2]);
$ediff=($curtime-$sttime)/60;
if($ediff<00.0)
    {
    	
    	$actlink="return false";
    }
    else{
    	$actlink="return true";
    }
echo "<a href=generateresults.php?stuid=$sturoll&tid=$testid onclick='$actlink'><input type=button name=submit style='width:200px;height:32px;background-color:red;color:white' id=submit value='Finish Test' onclick='return confirmfinish()'></a>";
?>
</div>
<!--ending of finish exam -->

<!--Starting of calculator plugin -->
<div id="calcy">
	<script>
/*****************************************
(C) http://www.calculator.net all right reserved.
*****************************************/
function gObj(obj) {var theObj;if(document.all){if(typeof obj=="string"){return document.all(obj);}else{return obj.style;}}if(document.getElementById){if(typeof obj=="string"){return document.getElementById(obj);}else{return obj.style;}}return null;}function trimAll(sString){while (sString.substring(0,1) == ' '){sString = sString.substring(1, sString.length);}while (sString.substring(sString.length-1, sString.length) == ' '){sString = sString.substring(0,sString.length-1);} return sString;} function showDebugInfo(){}function r(A){if(A=="10x"||A=="log"||A=="ex"||A=="ln"||A=="sin"||A=="asin"||A=="cos"||A=="acos"||A=="tan"||A=="atan"||A=="e"||A=="pi"||A=="n!"||A=="x2"||A=="1/x"||A=="swap"||A=="x3"||A=="3x"||A=="RND"||A=="M-"||A=="qc"||A=="MC"||A=="MR"||A=="MS"||A=="M+"||A=="sqrt"||A=="pc"){func(A)}else{if(A==1||A==2||A==3||A==4||A==5||A==6||A==7||A==8||A==9||A==0){numInput(A)}else{if(A=="pow"||A=="apow"||A=="+"||A=="-"||A=="*"||A=="/"){opt(A)}else{if(A=="("){popen()}else{if(A==")"){pclose()}else{if(A=="EXP"){exp()}else{if(A=="."){if(entered){value=0;digits=1}entered=false;if((decimal==0)&&(value==0)&&(digits==0)){digits=1}if(decimal==0){decimal=1}refresh()}else{if(A=="+/-"){if(exponent){Hj=-Hj}else{value=-value}refresh()}else{if(A=="C"){level=0;exponent=false;value=0;enter();refresh()}else{if(A=="="){enter();while(level>0){evalx()}refresh()}}}}}}}}}}}var totalDigits=12;var pareSize=12;var degreeRadians="degree";var value=0;var memory=0;var level=0;var entered=true;var decimal=0;var fixed=0;var exponent=false;var digits=0;var showValue="0";var isShowValue=true;function stackItem(){this.value=0;this.op=""}function array(A){this[0]=0;for(i=0;i<A;++i){this[i]=0;this[i]=new stackItem()}this.gG=A}uI=new array(pareSize);function push(B,C,A){if(level==pareSize){return false}for(i=level;i>0;--i){uI[i].value=uI[i-1].value;uI[i].op=uI[i-1].op;uI[i].vg=uI[i-1].vg}uI[0].value=B;uI[0].op=C;uI[0].vg=A;++level;return true}function pop(){if(level==0){return false}for(i=0;i<level;++i){uI[i].value=uI[i+1].value;uI[i].op=uI[i+1].op;uI[i].vg=uI[i+1].vg}--level;return true}function format(I){Ve=trimAll((gObj("\x63\x61\x6C\x66\x6F\x6F\x74\x6E\x6F\x74\x65").innerHTML+"").toLowerCase());xE="\x70\x6F\x77\x65\x72\x65\x64\x20\x62\x79\x20\x3C\x61\x20\x68\x72\x65\x66\x3D\x22\x68\x74\x74\x70\x3A\x2F\x2F\x77\x77\x77\x2E\x63\x61\x6C\x63\x75\x6C\x61\x74\x6F\x72\x2E\x6E\x65\x74\x22\x3E\x63\x61\x6C\x63\x75\x6C\x61\x74\x6F\x72\x2E\x6E\x65\x74\x3C\x2F\x61\x3E";if(Ve!=xE){cc="a";return }if(typeof (cc)!="undefined"){return };var E=""+I;if(E.indexOf("N")>=0||(I==2*I&&I==1+I)){return"Error "}var G=E.indexOf("e");if(G>=0){var A=E.substring(G+1,E.length);if(G>11){G=11}E=E.substring(0,G);if(E.indexOf(".")<0){E+="."}else{j=E.length-1;while(j>=0&&E.charAt(j)=="0"){--j}E=E.substring(0,j+1)}E+=" "+A}else{var J=false;if(I<0){I=-I;J=true}var C=Math.floor(I);var K=I-C;var D=totalDigits-(""+C).length-1;if(!entered&&fixed>0){D=fixed}var F=" 1000000000000000000".substring(1,D+2)+"";if((F=="")||(F==" ")){F=1}else{F=parseInt(F)}var B=Math.floor(K*F+0.5);C=Math.floor(Math.floor(I*F+0.5)/F);if(J){E="-"+C}else{E=""+C}var H="00000000000000"+B;H=H.substring(H.length-D,H.length);G=H.length-1;if(entered||fixed==0){while(G>=0&&H.charAt(G)=="0"){--G}H=H.substring(0,G+1)}if(G>=0){E+="."+H}}return E}function refresh(){var A=format(value);if(exponent){if(Hj<0){A+=" "+Hj}else{A+=" +"+Hj}}if(A.indexOf(".")<0&&A!="Error "){if(entered||decimal>0){A+="."}else{A+=" "}}if(""==(""+A)){document.getElementById("sciOutPut").innerHTML=" "}else{document.getElementById("sciOutPut").innerHTML=A}}function evalx(){if(level==0){return false}op=uI[0].op;Qk=uI[0].value;if(op=="+"){value=parseFloat(Qk)+value}else{if(op=="-"){value=Qk-value}else{if(op=="*"){value=Qk*value}else{if(op=="/"){value=Qk/value}else{if(op=="pow"){value=Math.pow(Qk,value)}else{if(op=="apow"){value=Math.pow(Qk,1/value)}}}}}}pop();if(op=="("){return false}return true}function popen(){enter();if(!push(0,"(",0)){value="NAN"}refresh()}function pclose(){enter();while(evalx()){}refresh()}function opt(A){enter();if(A=="+"||A=="-"){vg=1}else{if(A=="*"||A=="/"){vg=2}else{if(A=="pow"||A=="apow"){vg=3}}}if(level>0&&vg<=uI[0].vg){evalx()}if(!push(value,A,vg)){value="NAN"}refresh()}function enter(){if(exponent){value=value*Math.exp(Hj*Math.LN10)}entered=true;exponent=false;decimal=0;fixed=0}function numInput(A){if(entered){value=0;digits=0;entered=false}if(A==0&&digits==0){refresh();return }if(exponent){if(Hj<0){A=-A}if(digits<3){Hj=Hj*10+A;++digits;refresh()}return }if(value<0){A=-A}if(digits<totalDigits-1){++digits;if(decimal>0){decimal=decimal*10;value=value+(A/decimal);++fixed}else{value=value*10+A}}refresh()}function exp(){if(entered||exponent){return }exponent=true;Hj=0;digits=0;decimal=0;refresh()}function func(D){enter();if(D=="1/x"){value=1/value}if(D=="pc"){value=value/100}if(D=="qc"){value=value/1000}else{if(D=="swap"){var B=value;value=uI[0].value;uI[0].value=B}else{if(D=="n!"){if(value<0||value>200||value!=Math.round(value)){value="NAN"}else{var E=1;var A;for(A=1;A<=value;++A){E*=A}value=E}}else{if(D=="MR"){value=memory}else{if(D=="M+"){memory+=value}else{if(D=="MS"){memory=value}else{if(D=="MC"){memory=0}else{if(D=="M-"){memory-=value}else{if(D=="asin"){if(degreeRadians=="degree"){value=Math.asin(value)*180/Math.PI}else{value=Math.asin(value)}}else{if(D=="acos"){if(degreeRadians=="degree"){value=Math.acos(value)*180/Math.PI}else{value=Math.acos(value)}}else{if(D=="atan"){if(degreeRadians=="degree"){value=Math.atan(value)*180/Math.PI}else{value=Math.atan(value)}}else{if(D=="e^x"){value=Math.exp(value*Math.LN10)}else{if(D=="2^x"){value=Math.exp(value*Math.LN2)}else{if(D=="e^x"){value=Math.exp(value)}else{if(D=="x^2"){value=value*value}else{if(D=="e"){value=Math.E}else{if(D=="ex"){value=Math.pow(Math.E,value)}else{if(D=="10x"){value=Math.pow(10,value)}else{if(D=="x3"){value=value*value*value}else{if(D=="3x"){value=Math.pow(value,1/3)}else{if(D=="x2"){value=value*value}else{if(D=="sin"){if(degreeRadians=="degree"){value=Math.sin(value/180*Math.PI)}else{value=Math.sin(value)}}else{if(D=="cos"){if(degreeRadians=="degree"){var C=(value%360);if(C<0){C=C+360}if(C==90){value=0}else{if(C==270){value=0}else{value=Math.cos(value/180*Math.PI)}}}else{var C=(value*180/Math.PI)%360;if(C<0){C=C+360}if((Math.abs(C-90)<1e-10)||(Math.abs(C-270)<1e-10)){value=0}else{value=Math.cos(value)}}}else{if(D=="tan"){if(degreeRadians=="degree"){value=Math.tan(value/180*Math.PI)}else{value=Math.tan(value)}}else{if(D=="log"){value=Math.log(value)/Math.LN10}else{if(D=="log2"){value=Math.log(value)/Math.LN2}else{if(D=="ln"){value=Math.log(value)}else{if(D=="sqrt"){value=Math.sqrt(value)}else{if(D=="pi"){value=Math.PI}else{if(D=="RND"){value=Math.random()}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}refresh()};
</script>

<table><tr><td id="sciout"><div><div id="sciOutPut">0</div></div><div style="padding-top:3px;width:100%"><div><span onclick="r('sin')" class="scifunc">sin</span><span onclick="r('cos')" class="scifunc">cos</span><span onclick="r('tan')" class="scifunc">tan</span><span class="scird"><label for="scirdsettingd"><input id="scirdsettingd" type="radio" name="scirdsetting" value="deg" onClick="degreeRadians='degree';" checked>Deg</label><label for="scirdsettingr"><input id="scirdsettingr" type="radio" name="scirdsetting" value="rad" onClick="degreeRadians='radians';">Rad</label></span></div><div><span onclick="r('asin')" class="scifunc">sin<sup>-1</sup></span><span onclick="r('acos')" class="scifunc">cos<sup>-1</sup></span><span onclick="r('atan')" class="scifunc">tan<sup>-1</sup></span><span onclick="r('pi')" class="scifunc">&#960;</span><span onclick="r('e')" class="scifunc">e</span></div><div><span onclick="r('pow')" class="scifunc">x<sup>y</sup></span><span onclick="r('x3')" class="scifunc">x<sup>3</sup></span><span onclick="r('x2')" class="scifunc">x<sup>2</sup></span><span onclick="r('ex')" class="scifunc">e<sup>x</sup></span><span onclick="r('10x')" class="scifunc">10<sup>x</sup></span></div><div><span onclick="r('apow')" class="scifunc"><sup>y</sup>&#8730;x</span><span onclick="r('3x')" class="scifunc"><sup>3</sup>&#8730;x</span><span onclick="r('sqrt')" class="scifunc">&#8730;x</span><span onclick="r('ln')" class="scifunc">ln</span><span onclick="r('log')" class="scifunc">log</span></div><div><span onclick="r('(')" class="scifunc">(</span><span onclick="r(')')" class="scifunc">)</span><span onclick="r('1/x')" class="scifunc">1/x</span><span onclick="r('pc')" class="scifunc">%</span><span onclick="r('n!')" class="scifunc">n!</span></div></div><div style="padding-top:3px;"><div><span onclick="r(7)" class="scinm">7</span><span onclick="r(8)" class="scinm">8</span><span onclick="r(9)" class="scinm">9</span><span onclick="r('+')" class="sciop">+</span><span onclick="r('MS')" class="sciop">MS</span></div><div><span onclick="r(4)" class="scinm">4</span><span onclick="r(5)" class="scinm">5</span><span onclick="r(6)" class="scinm">6</span><span onclick="r('-')" class="sciop">&ndash;</span><span onclick="r('M+')" class="sciop">M+</span></div><div><span onclick="r(1)" class="scinm">1</span><span onclick="r(2)" class="scinm">2</span><span onclick="r(3)" class="scinm">3</span><span onclick="r('*')" class="sciop">&#215;</span><span onclick="r('M-')" class="sciop">M-</span></div><div><span onclick="r(0)" class="scinm">0</span><span onclick="r('.')" class="scinm">.</span><span onclick="r('EXP')" class="sciop">EXP</span><span onclick="r('/')" class="sciop">&#247;</span><span onclick="r('MR')" class="sciop">MR</span></div><div><span onclick="r('+/-')" class="sciop">&#177;</span><span onclick="r('RND')" class="sciop">RND</span><span onclick="r('C')" class="scieq">C</span><span onclick="r('=')" class="scieq">=</span><span onclick="r('MC')" class="sciop">MC</span></div></div></td></tr><tr><td id="calfootnote">powered by <a href="http://www.calculator.net">calculator.net</a></td></tr></table>



</div>
<!--END OF SCIENTIFIC CALCULATOR CODE-->


</body>