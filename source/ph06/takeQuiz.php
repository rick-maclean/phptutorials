<?
//takeQuiz.php
//given a quiz file, prints out that quiz

//get the password from the file
$masterFile = $takeFile . ".mas";
$fp = fopen($masterFile, "r");
//the password is the third line, so get the first two lines, but ignore them
$dummy = fgets($fp);
$dummy = fgets($fp);
$magicWord = fgets($fp);
$magicWord = rtrim($magicWord);
fclose($fp);

if ($password == $magicWord){
  $htmlFile = $takeFile . ".html";
  //print out the page if the user got the password right
  readFile($htmlFile);
} else {
  print <<<HERE
  <font color = "red"
        size = +3>
Incorrect Password.<br>
You must have a password in order to take this quiz
</font>

HERE;
} // end if
?>


