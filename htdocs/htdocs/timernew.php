<?php
session_start();
$cutoff=$_SESSION['timer'];
var_dump($cutoff);
?>
<html>
<body>
<div id="countdown"></div>
<div id="notifier"></div>
 
<script type="text/javascript">
 
(function () {
  function display( notifier, str ) {
    document.getElementById(notifier).innerHTML = str;
  }
 
  function toMinuteAndSecond( x ) {
    return Math.floor(x/60) + ":" + (x=x%60 < 10 ? 0 : x);
  }
 
  function setTimer( remain, actions ) {
    var action;
    (function countdown() {
       display("countdown", toMinuteAndSecond(remain));
       if (action = actions[remain]) {
         action();
       }
       if (remain > 0) {
         remain -= 1;
         setTimeout(arguments.callee, 1000);
       }
    })(); // End countdown
  }
 
  setTimer(<?php echo"$cutoff";?>, {
    10: function () { display("notifier", "Just 10 seconds to go"); },
     5: function () { display("notifier", "5 seconds left");        },
     0: function () { display("notifier", "Time is up ");       }
  });
})();
 
</script>
</body>
</html>