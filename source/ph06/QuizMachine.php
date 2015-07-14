<html>
<head>
<title>Quiz Machine</title>
</head>
<body>
<center>
<h1>Quiz Machine</h1>


<?

getFiles();
showTest();
showEdit();
showLog();

function getFiles(){
  //get list of all files for use in other routines


  global $dirPtr, $theFiles;
  
  chdir(".");
  $dirPtr = openDir(".");
  $currentFile = readDir($dirPtr);
  while ($currentFile !== false){
    $theFiles[] = $currentFile;
    $currentFile = readDir($dirPtr);
  } // end while

} // end getFiles


function showTest(){
  //print a list of tests for user to take

  global $theFiles;
  print <<<HERE
<form action = "takeQuiz.php"
      method = "post">

<table border = 1
       width = 400>
<tr>
  <td colspan = 2><center>
    <h3>Take a quiz</h3>
  </td>
</tr>

<tr>
  <td>Quiz Password</td>
  <td>
    <input type = "password"
           name = "password">
  </td>
</tr>

<tr>
  <td>Quiz</td>
  <td>
    <select name = "takeFile">

HERE;

  //select only quiz html files
  $testFiles = preg_grep("/html$/", $theFiles);

  foreach ($testFiles as $myFile){
    $fileBase = substr($myFile, 0, strlen($myFile) - 5);
    print "    <option value = $fileBase>$fileBase</option>\n";
  } // end foreach

  print <<<HERE
    </select>
  </td>
</tr>

<tr>
  <td colspan = 2><center>
    <input type = "submit"
           value = "go">
  </center></td>
</tr>
</table>
       
</form>

HERE;

} // end showTest

function showEdit(){
  // let user select a master file to edit

  global $theFiles;
  //get only quiz master files
  $testFiles = preg_grep("/mas$/", $theFiles);

  //edit a quiz
  print <<<HERE
<form action = "editQuiz.php"
      method = "post">
<table border = 1
       width = 400>
<tr>
  <td colspan = 2><center>
    <h3>Edit a quiz</h3>
  </center></td>
</tr>

<tr>
  <td>Administrative Password</td>
  <td>
    <input type = "password"
           name = "password"
           value = "">
  </td>
</tr>

<tr>
  <td>Quiz</td>
  <td>
    <select name = "editFile">
      <option value = "new">new quiz</option>

HERE;
  foreach ($testFiles as $myFile){
    $fileBase = substr($myFile, 0, strlen($myFile) - 4);
    print "  <option value = $myFile>$fileBase</option>\n";
  } // end foreach

  print <<<HERE
    </select>
  </td>
</tr>

<tr>
  <td colspan = 2><center>
    <input type = "submit"
           value = "go">
  </center></td>
</tr>
</table>
</form>

HERE;

} // end showEdit

function showLog(){

  //let user choose from a list of log files
  global $theFiles;
  
  print <<<HERE

<form action = "showLog.php"
      method = "post">
<table border = 1
       width = 400>
<tr>
  <td colspan = 2><center>
    <h3>Show a log file</h3>
  </td>
</tr>

<tr>
  <td>Administrative Password</td>
  <td>
    <input type = "password"
           name = "password"
           value = "">
  </td>
</tr>

<tr>
  <td>Quiz</td>
  <td>
    <select name = "logFile">

HERE;

  //select only log files
  $logFiles = preg_grep("/log$/", $theFiles);
  foreach ($logFiles as $myFile){
    $fileBase = substr($myFile, 0, strlen($myFile) - 4);
    print "      <option value = $myFile>$fileBase</option>\n";
  } // end foreach

  print <<<HERE
    </select>
  </td>
</tr>

<tr>
  <td colspan = 2><center>
    <input type = "submit"
           value = "go">
  </td>
</tr>
</table>
</form>

HERE;
} // end showLog

?>

</center>
</body>
</html>
