<html>
<head>
<title>
Word Find
</title>
</head>

<body>

<?
// word Find
// by Andy Harris, 2003
// for PHP/MySQL programming for the Absolute Beginner
// Generates a word search puzzle based on a word list
// entered by user.  User can also specify the size of
// the puzzle and print out an answer key if desired

//check for a word list
if ($wordList == NULL){
  //make default puzzle
  $word = array(
    "ANDY",
    "HEATHER",
    "LIZ",
    "MATT",
    "JACOB"
    );
  $boardData = array(
    width => 10,
    height => 10,
    name => "Generic Puzzle"
  );

} else {
  //get puzzle data from HTML form
  $boardData = array(
    width => $width,
    height => $height,
    name => $name
  );
  
  //try to get a word list from user input
  if (parseList() == TRUE){
    $legalBoard = FALSE;

    //keep trying to build a board until you get a legal result
    while ($legalBoard == FALSE){
      clearBoard();
      $legalBoard = fillBoard();
    } // end while

    //make the answer key
    $key = $board;
    $keyPuzzle = makeBoard($key);

    //make the final puzzle
    addFoils();
    $puzzle = makeBoard($board);

    //print out the result page
    printPuzzle();
    
  } // end parsed list if
} // end word list exists if

function parseList(){
  //gets word list, creates array of words from it
  //or return false if impossible
  
  global $word, $wordList, $boardData;
  
  $itWorked = TRUE;
  
  //convert word list entirely to upper case
  $wordList = strtoupper($wordList);

  //split word list into array
  $word = split("\n", $wordList);

  foreach ($word as $currentWord){
    //take out trailing newline characters
    $currentWord = rtrim($currentWord);

    //stop if any words are too long to fit in puzzle
    if ((strLen($currentWord) > $boardData["width"]) &&
        (strLen($currentWord) > $boardData["height"])){
      print "$currentWord is too long for puzzle";
      $itWorked = FALSE;
    } // end if

  } // end foreach
  return $itWorked;
} // end parseList

function clearBoard(){
  //initialize board with a . in each cell
  global $board, $boardData;

  for ($row = 0; $row < $boardData["height"]; $row++){
    for ($col = 0; $col < $boardData["width"]; $col++){
      $board[$row][$col] = ".";
    } // end col for loop
  } // end row for loop
} // end clearBoard

function addWord($theWord, $dir){
  //attempt to add a word to the board or return false if failed
  global $board, $boardData;
  
  //remove trailing characters if necessary
  $theWord = rtrim($theWord);
  
  $itWorked = TRUE;
  
  switch ($dir){
  	case "E":
  	  //col from 0 to board width - word width
      //row from 0 to board height
      $newCol = rand(0, $boardData["width"] - 1 - strlen($theWord)); 
  	  $newRow = rand(0, $boardData["height"]-1);

      for ($i = 0; $i < strlen($theWord); $i++){
        //new character same row, initial column + $i
        $boardLetter = $board[$newRow][$newCol + $i];
        $wordLetter = substr($theWord, $i, 1);
        
        //check for legal values in current space on board
        if (($boardLetter == $wordLetter) ||
            ($boardLetter == ".")){
          $board[$newRow][$newCol + $i] = $wordLetter;
        } else {
          $itWorked = FALSE;
        } // end if
      } // end for loop
      break;
      
  	case "W":
  	  //col from word width to board width
  	  //row from 0 to board height
      $newCol = rand(strlen($theWord), $boardData["width"] -1); 
      $newRow = rand(0, $boardData["height"]-1);
      //print "west:\tRow: $newRow\tCol: $newCol<br>\n";
  
      for ($i = 0; $i < strlen($theWord); $i++){
        //check for a legal move
        $boardLetter = $board[$newRow][$newCol - $i];
        $wordLetter = substr($theWord, $i, 1);
        if (($boardLetter == wordLetter) ||
            ($boardLetter == ".")){
          $board[$newRow][$newCol - $i] = $wordLetter;
        } else {
          $itWorked = FALSE;
        } // end if
      } // end for loop
      break;
      
    case "S":
  	  //col from 0 to board width
  	  //row from 0 to board height - word length
      $newCol = rand(0, $boardData["width"] -1);
      $newRow = rand(0, $boardData["height"]-1 - strlen($theWord));
      //print "south:\tRow: $newRow\tCol: $newCol<br>\n";

      for ($i = 0; $i < strlen($theWord); $i++){
        //check for a legal move
        $boardLetter = $board[$newRow + $i][$newCol];
        $wordLetter = substr($theWord, $i, 1);
        if (($boardLetter == $wordLetter) ||
            ($boardLetter == ".")){
          $board[$newRow + $i][$newCol] = $wordLetter;
      	} else {
         $itWorked = FALSE;
      	} // end if
      } // end for loop
      break;

    case "N":
  	  //col from 0 to board width
  	  //row from word length to board height
      $newCol = rand(0, $boardData["width"] -1);
      $newRow = rand(strlen($theWord), $boardData["height"]-1);

      for ($i = 0; $i < strlen($theWord); $i++){
        //check for a legal move
        $boardLetter = $board[$newRow - $i][$newCol];
        $wordLetter = substr($theWord, $i, 1);
        if (($boardLetter == $wordLetter) ||
            ($boardLetter == ".")){
          $board[$newRow - $i][$newCol] = $wordLetter;
      	} else {
         $itWorked = FALSE;
      	} // end if
      } // end for loop
      break;

  } // end switch
  return $itWorked;
} // end addWord

function fillBoard(){
  //fill board with list by calling addWord() for each word
  //or return false if failed
  
  global $word;
  $direction = array("N", "S", "E", "W");
  $itWorked = TRUE;
  $counter = 0;
  $keepGoing = TRUE;
  while($keepGoing){
    $dir = rand(0, 3);
    $result = addWord($word[$counter], $direction[$dir]);
    if ($result == FALSE){
      //print "failed to place $word[$counter]";
      $keepGoing = FALSE;
      $itWorked = FALSE;
    } // end if
    $counter++;
    if ($counter >= count($word)){
      $keepGoing = FALSE;
    } // end if
  } // end while
  return $itWorked;
  
} // end fillBoard
  
function makeBoard($theBoard){
  //given a board array, return an HTML table based on the array
  global $boardData;
  $puzzle = "";
  $puzzle .= "<table border = 0>\n";
  //check logic here
  for ($row = 0; $row < $boardData["height"]; $row++){
  	$puzzle .= "<tr>\n";
    for ($col = 0; $col < $boardData["width"]; $col++){
      $puzzle .= "  <td width = 15>{$theBoard[$row][$col]}</td>\n";
    } // end col for loop
    $puzzle .= "</tr>\n";
  } // end row for loop
  $puzzle .= "</table>\n";
  return $puzzle;
} // end printBoard;

function addFoils(){
  //add random dummy characters to board
  global $board, $boardData;
  for ($row = 0; $row < $boardData["height"]; $row++){
    for ($col = 0; $col < $boardData["width"]; $col++){
      if ($board[$row][$col] == "."){
        $newLetter = rand(65, 90);
        $board[$row][$col] = chr($newLetter);
      } // end if
    } // end col for loop
  } // end row for loop
} // end addFoils

function printPuzzle(){
  //print out page to user with puzzle on it
  
  global $puzzle, $word, $keyPuzzle, $boardData;
  //print puzzle itself
  
  print <<<HERE
  <center>
  <h1>{$boardData["name"]}</h1>
  $puzzle
  <h3>Word List</h3>
  <table border = 0>

HERE;
  //print word list
  foreach ($word as $theWord){
    print "<tr><td>$theWord</td></tr>\n";
  } // end foreach
  print "</table>\n";
  $puzzleName = $boardData["name"];

  //print form for requesting answer key.
  //send answer key to that form (sneaky!)
  print <<<HERE
  <br><br><br><br><br><br><br><br>
  <form action = "wordFindKey.php"
        method = "post">
  <input type = "hidden"
         name = "key"
         value = "$keyPuzzle">
  <input type = "hidden"
         name = "puzzleName"
         value = "$puzzleName">
         
  <input type = "submit"
         value = "show answer key">
  </form>
  </center>

HERE;

} // end printPuzzle


?>


</body>
</html>
