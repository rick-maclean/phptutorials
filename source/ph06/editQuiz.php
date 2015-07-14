<!doctype html public "-//W3C//DTD HTML 4.0 //EN"> 
<html>
<head>
<title>Quiz Builder</title>
</head>
<body>
<?

if ($password != "absolute"){
  print <<<HERE

<font color = "red" size = +3>
Invalid Password!
</font>

HERE;
} else {
  //check to see if user has chosen a form to edit
  if ($editFile == "new"){
    //if it's a new file, put in some dummy values
    $quizName = "sample test";
    $quizEmail = "root@localhost";
    $quizData = "q:a:b:c:d:correct";
    $quizPwd = "php";
  } else {
    //open up the file and get the data from it
    $fp = fopen($editFile, "r");
    $quizName = fgets($fp);
    $quizEmail = fgets($fp);
    $quizPwd = fgets($fp);
    while (!feof($fp)){
      $quizData .= fgets($fp);
    } // end while
} // end 'new form' if


print <<<HERE

<form action = "writeQuiz.php"
      method = "post">
      
<table border = 1>
<tr>
  <th>Quiz Name</th>
  <td>
    <input type = "text"
           name = "quizName"
           value = "$quizName">
  </td>
</tr>

<tr>
  <th>Instructor email</th>
  <td>
    <input type = "text"
           name = "quizEmail"
           value = "$quizEmail">
  </td>
</tr>

<tr>
  <th>Password</th>
  <td>
    <input type = "text"
           name = "quizPwd"
           value = "$quizPwd">

<tr>
  <td rowspan = 1
      colspan = 2>
    <textarea name = "quizData"
              rows = 20
              cols = 60>
$quizData</textarea>
  </td>
</tr>

<tr>
  <td colspan = 2><center>
    <input type = "submit"
           value = "make the quiz">
  </center></td>
</tr>

</table>
</form>
HERE;
} // end if

?>
</body>
</html>


