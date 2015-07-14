<?
//showLog.php
//shows a log file
//requires admin password

if ($password == "absolute"){
  $lines = file($logFile);
  print "<pre>\n";
  foreach ($lines as $theLine){
    print $theLine;
  } // end foreach
  print "</pre>\n";

} else {
  print <<<HERE
<font color = "red"
      size = +2>
You must have the appropriate password to view this log
</font>

HERE;
} // end if

?>

