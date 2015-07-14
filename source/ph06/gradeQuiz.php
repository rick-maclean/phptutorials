<?
print <<<HERE
<html>
<head>
<title>Grade for $quizName, $student</title>
</head>
<body>

</body>
<h1>Grade for $quizName, $student</h1>
HERE;

//open up the correct master file for reading
$fileBase = str_replace(" ", "_", $quizName);
$masFile = $fileBase . ".mas";
$msfp = fopen($masFile, "r");

$logFile = $fileBase . ".log";

//the first three lines are name, instructor's email, and password
$quizName = fgets($msfp);
$quizEmail = fgets($msfp);
$quizPwd = fgets($msfp);

//step through the questions building an answer key
$numCorrect = 0;
$questionNumber = 1;
while (!feof($msfp)){
  $currentProblem = fgets($msfp);
  
  list($question, $answerA, $answerB, $answerC, $answerD, $correct) =
  split (":", $currentProblem);
  $key[$questionNumber] = $correct;
  $questionNumber++;
} // end while
fclose($msfp);

//Check each answer from user
for ($questionNumber = 1; $questionNumber <= count($quest); $questionNumber++){
  $guess = $quest[$questionNumber];
  $correct = $key[$questionNumber];
  $correct = rtrim($correct);
  //print "$questionNumber, Guess = $guess, Correct = $correct.<br>\n";
  if ($guess == $correct){
    //user got it right
    $numCorrect++;
    print "problem # $questionNumber was correct<br>\n";
  } else {
    print "<font color = red>problem # $questionNumber was incorrect</font><br>\n";
  } // end if
} // end for

print "you got $numCorrect right<br>\n";
$percentage = ($numCorrect /count($quest)) * 100;
print "for $percentage percent<br>\n";

$today = date ("F j, Y, g:i a");
//print "Date: $today<br>\n";
$location = getenv("REMOTE_ADDR");
//print "Location: $location<br>\n";

//add results to log file
$lgfp = fopen($logFile, "a");
$logLine = $student . "\t";
$logLine .= $today . "\t";
$logLine .= $location . "\t";
$logLine .= $numCorrect . "\t";
$logLine .= $percentage . "\n";

fputs($lgfp, $logLine);
fclose($lgfp);

?>

</html>
