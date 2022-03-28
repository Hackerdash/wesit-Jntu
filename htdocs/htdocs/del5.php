<?php

?>
<html>
<script>
function fun1(){
newwindow = window.open("index.php", "_blank", "resizable=no, scrollbars=yes, titlebar=yes,width=800, height=g, top=0, left=0");
}
</script>

<script type="text/javascript">
function popup(url) 
{
 params  = 'width='+screen.width;
 params += ', height='+screen.height;
 params += ', top=0, left=0,';
 params += ', fullscreen=yes';

 newwin=window.open(url,'Online Examination Portal',params+'directories=no,location=no,menubar=no,resizable=no,scrollbars=1,status=no,toolbar=yes'); 
  return false;
 if (window.focus) {newwin.focus()}
 return false;
}

</script>
<body>
<a href="javascript: void(0)" 
   onclick="popup('eindex.php')"><img src="images/banner.jpg"/></a>
</body>
</html>