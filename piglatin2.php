<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Convert to PigLatin</title>
</head>
<body>

<h1>Convert to PigLatin22222</h1>

<?php

if (!isset($_REQUEST['inputstring']))
{
	print <<<HERE
	<form>
	<textarea rows="20" cols="40" name="inputstring"></textarea>
	<br>
	<input type="submit" name="convert" value="Convert">
	</form>
HERE;
	
}
else 
{
	//$inputstring has a value so process it
	$inputstring = $_REQUEST['inputstring'];
	print ("Input string is: $inputstring <br><br>");
		
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
	
?>

</body>
</html>