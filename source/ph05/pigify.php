<!doctype html public "-//W3C//DTD HTML 4.0 //EN"> 
<html>
<head>
       <title>Pig Latin Generator</title>
</head>
<body>
<h1>Pig Latin Generator</h1>
<?
if ($inputString == NULL){
  print <<<HERE
  <form>
  <textarea name = "inputString"
            rows = 20
            cols = 40></textarea>
   <input type = "submit"
          value = "pigify">
   </form>
   
HERE;
} else {
  //there is a value, so we'll deal with it
  
  //break phrase into array
  $words = split(" ", $inputString);
  foreach ($words as $theWord){
    $theWord = rtrim($theWord);
    $firstLetter = substr($theWord, 0, 1);
    $restOfWord = substr($theWord, 1, strlen($theWord)-1);
    //print "$firstLetter) $restOfWord <br> \n";
    if (strstr("aeiouAEIOU", $firstLetter)){
      //it's a vowel
      $newWord = $theWord . "way";
    } else {
      //it's a consonant
      $newWord = $restOfWord . $firstLetter . "ay";
    } // end if
    $newPhrase = $newPhrase . $newWord . " ";
  } // end foreach
  print $newPhrase;

} // end if
  
?>


</body>
</html>
