<html>
<head>
<title>Write Quiz</title>
</head>
<body>
<?
//given a quiz file from editQuiz,
//generates a master file and an HTML file for the quiz

//open the output file
$fileBase = str_replace(" ", "_", $quizName);
$htmlFile = $fileBase . ".html";
$masFile = $fileBase . ".mas";

$htfp = fopen($htmlFile, "w");
$htData = buildHTML();
fputs($htfp, $htData);
fclose($htfp);

$msfp = fopen($masFile, "w");
$msData = buildMas();
fputs($msfp, $msData);
print <<<HERE
<pre>
$msData
</pre>

HERE;

fclose($msfp);

function buildMas(){
  //builds the master file
  global $quizName, $quizEmail, $quizPwd, $quizData;
  $msData = $quizName . "\n";
  $msData .= $quizEmail . "\n";
  $msData .= $quizPwd . "\n";
  $msData .=  $quizData;
  return $msData;
} // end buildMas

function buildHTML(){
  global $quizName, $quizData;
  $htData = <<<HERE
<html>
<head>
<title>$quizName</title>
</head>
<body>

HERE;

  //get the quiz data
  $problems = split("\n", $quizData);
  $htData .= <<<HERE
<center>
<h1>$quizName</h1>
</center>

<form action = "gradeQuiz.php"
      method = "post">

Name
<input type = "text"
       name = "student">

<ol>

HERE;
  $questionNumber = 1;

  foreach ($problems as $currentProblem){
      list($question, $answerA, $answerB, $answerC, $answerD, $correct) =
      explode (":", $currentProblem);
      $htData .= <<<HERE
<li>
  $question
  <ol type = "A">
    <li>
      <input type = "radio"
             name = "quest[$questionNumber]"
             value = "A">
      $answerA
    </li>

    <li>
      <input type = "radio"
             name = "quest[$questionNumber]"
             value = "B">
      $answerB
    </li>

    <li>
      <input type = "radio"
             name = "quest[$questionNumber]"
             value = "C">
      $answerC
    </li>

    <li>
      <input type = "radio"
             name = "quest[$questionNumber]"
             value = "D">
      $answerD
    </li>

  </ol>
  <hr>
</li>

HERE;
    $questionNumber++;
  
  } // end foreach
  $htData .= <<<HERE
</ol>

<input type = "hidden"
       name = "quizName"
       value = "$quizName">
       
<input type = "submit"
       value = "submit quiz">
       
</form>

HERE;

  print $htData;
  return $htData;
} // end buildHTML


?>
</body>
</html>
