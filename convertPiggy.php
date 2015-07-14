<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Convert to PigLatin</title>
</head>
<body>

<h1>String Converted to PigLatin</h1>
<?php
$inputstring = $_REQUEST['inputstring'];
print ("Input string is: $inputstring <br><br>");
if (isset($inputstring))
{
	//$inputstring has a value so process it
	//break it up into words
	$words = split(" ", $inputstring);
	foreach ($words as $currentWord)
	{
		$firstLetter = substr($currentWord, 0, 1);
		$restOfWord = substr($currentWord, 1, strlen($currentWord)-1); //since 0 based index

		print "debugging |$firstLetter| |$restOfWord| <br> \n";
	}
	foreach ($words as $currentWord)
	{
		$firstLetter = substr($currentWord, 0, 1);
		$restOfWord = substr($currentWord, 1, strlen($currentWord)-1); //since 0 based index
	
		if (strstr("aeiouAEIOU", $firstLetter))
		{
			//it is a vowel to end the word with 'nay'
			$newword = $currentWord . 'way';
		}
		else 
		{
			//consonant starts word soooo
			$newword = $restOfWord . $firstLetter . "ay";
		}
		$newPhrase = $newPhrase . $newword . ' ';
	}
	print "$newPhrase";
}
print <<<HERE
<form action=piglatin.php>
<p>Press button to go back</p>
<br>
<input type="submit" value="GoBack">
</form>
HERE;

?>


</body>
</html>
