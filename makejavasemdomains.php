<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Convert to PigLatin</title>
</head>
<body>

<h1>SemDomainsRewrite</h1>
<br>
// You can find instructions for this file here:<br>
// http://www.treeview.net<br>
<br>
// Decide if the names are links or just the icons<br>
USETEXTLINKS = 1  //replace 0 with 1 for hyperlinks<br>
<br>
// Don't use icons<br>
USEICONS = 0<br>
<br>
// Decide if the tree is to start all open or just showing the root folders<br>
STARTALLOPEN = 0 //replace 0 with 1 to show the whole tree<br>
<br>
ICONPATH = '/wp-content/plugins/sil-dictionary-webonary/images/' //change if the gif's folder is a subfolder, for example: 'images/'<br>
<br>
foldersTree = gFld("", "")<br>
<br>
<?php


$roots = array( 'no 0 domain',
		' aux1 = insFld(foldersTree, gFld("1. Universe, creation", "c0001.htm"))',
		' aux1 = insFld(foldersTree, gFld("2. Person", "c0105.htm"))',
		' aux1 = insFld(foldersTree, gFld("3. Language and thought", "c0241.htm"))',
		' aux1 = insFld(foldersTree, gFld("4. Social behavior", "c0472.htm"))',
		' aux1 = insFld(foldersTree, gFld("5. Daily life", "c0803.htm"))',
		' aux1 = insFld(foldersTree, gFld("6. Work and occupation", "c0900.htm"))',
		' aux1 = insFld(foldersTree, gFld("7. Physical actions", "c1141.htm"))',
		' aux1 = insFld(foldersTree, gFld("8. States", "c1314.htm"))',
		' aux1 = insFld(foldersTree, gFld("9. Grammar", "c1599.htm"))'
		);
$rootDomainPrinted = array('no zero domain',
		'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no');

//define a way to keep track of which semantic domain parents have been processed already.
//eg is we have 1.3.1.1 and the odomerter says 1,3,0,0,0,0 then we need to first output 1,3,1
$lastSemDom = array (0,0,0,0,0,0);
$lastSemDomLevel = 0;

//processFromTextBox();
processFromFile();
?>

<?php 
function processFromFile()
{
	global $lastSemDom;
	global $lastSemDomLevel;
	 $file = fopen("SemDomainsSena3Copy.txt","r");
	 while (!feof($file))
	 {
		 $currentSemDomain = fgets($file);
		 //print "$currentSemDomain<br>";
		 $parsedData = split(" ", $currentSemDomain);
		 $domainNumber = $parsedData[0];
		 $levelOfDomain = substr_count("$domainNumber","-") + 1;
		 
		 printRootDomainIfNeeded($domainNumber);
		 
		 buildTreeToSupportThisItem($domainNumber, $levelOfDomain);
		 
		 $domainNumberModified = preg_replace('/-/', '.', $domainNumber) . '.';
		 $newString = "$domainNumberModified" . substr($currentSemDomain, strlen($domainNumber), strlen($currentSemDomain));
		 outputSemDomAsJava($levelOfDomain, $newString);
		 $currentDigits = split('-', $domainNumber);
		 setLastSemDom($currentDigits);
	 }
	 fclose($file); 
}

function setLastSemDom($currentDigits)
{
	global $lastSemDom;
	global $lastSemDomLevel;
	$lastSemDom = array (0,0,0,0,0,0);
	for ($i=0; $i<count($currentDigits); $i++)
	{
		$lastSemDom[$i] = $currentDigits[$i];
	}
	$lastSemDomLevel = count($lastSemDom);

}

function buildTreeToSupportThisItem($domainNumber, $levelOfDomain)
{
	global $lastSemDom;
	global $lastSemDomLevel;
		
	//First insert the standard tree root element if it is needed here.
	//printRootDomainIfNeeded($domainNumber);
	$currentDomainDigits = split('-', $domainNumber);
	$currentDomainCount = count($currentDomainDigits);

	//printDomainDigits('$currentDomainDigits is ', $currentDomainDigits);
	//printDomainDigits('$lastSemDom is ', $lastSemDom);
	//solve this
	//1.1.1.6  last one printed  to
	//1.2.2.3  current one
	//need 1.2, 1.2.2 before 1.2.2.3
	
	$strToPrint = $lastSemDom[0].'.';
	$currentDigits = array($lastSemDom[0]);
	//Note skip the first digit since we printed it already
	for ($i=1; $i<$currentDomainCount-1; $i++)
	{
		$strToPrint = $strToPrint . $currentDomainDigits[$i] . ".";
		$currentDigits[$i] = $currentDomainDigits[$i];
		if ($currentDomainDigits[$i] > $lastSemDom[$i])
		{
			//print "about to print $strToPrint as output <br>";
			outputSemDomAsJava($i+1, $strToPrint);
			setLastSemDom($currentDigits);
		}
	}
}

function printDomainDigits($whatisstring, $digitsArray)
{
	print $whatisstring . ': ';
	$numDigits = count($digitsArray);
	for ($i=0; $i<$numDigits; $i++)
	{
		print "$digitsArray[$i]" . '.';
	}
	print '<br>';
}

function printRootDomainIfNeeded($domainNumber)
{
	global $lastSemDom;
	global $lastSemDomLevel;
	global $rootDomainPrinted;
	global $roots;
	$rootDomain = substr($domainNumber, 0, 1);
	//print "rootDomain:$rootDomain rootDomainPrinted:$rootDomainPrinted[$rootDomain] ";
	if ("$rootDomainPrinted[$rootDomain]" =="no")
	{
		print "$roots[$rootDomain] <br>";
		$rootDomainPrinted[$rootDomain] = "yes";

		$lastSemDom = array($rootDomain,0,0,0,0);
		$lastSemDomLevel = 1;
		//printlastNamelessSemDom ();
	}
}

function outputSemDomAsJava($levelOfDomain, $newString)
{
	$levelMinus1 = (string)$levelOfDomain-1;
	print 'aux' . (string)$levelOfDomain . '= insFld(aux' . $levelMinus1 . ', gFld("';
    print "$newString";
	print '", "c1000.htm"))<br>';		
}

?>

<?php 
function processFromTextBox()
{
	$semanticDomains = $_REQUEST['semanticDomains'];
	//print ("Input string is: $semanticDomains <br><br>");
	$semanticDomainsArray = split("\n", $semanticDomains);
	foreach ($semanticDomainsArray as $semanticDomain)
	{
		//print ("$semanticDomain <br>");
		$parsedData = split(" ", $semanticDomain);
		$domainNumber = $parsedData[0];
		$rootDomain = substr($domainNumber, 0, 1);
		//print "rootDomain:$rootDomain rootDomainPrinted:$rootDomainPrinted[$rootDomain] ";
		if ("$rootDomainPrinted[$rootDomain]" =="no")
		{
			print "$roots[$rootDomain] <br>";
			$rootDomainPrinted[$rootDomain] = "yes";
		}
		$domainNumberModified = preg_replace('/-/', '.', $domainNumber) . '.';
		$levelOfDomain = substr_count("$domainNumber","-") + 1;
		//print "levelOfDomain:$levelOfDomain,     ";
		$newString = "$domainNumberModified" . substr($semanticDomain, strlen($domainNumber), strlen($semanticDomain));
		//print "$newString <br>";

		//print ('aux' . '$levelOfDomain = insFld(aux');

		outputJava($levelOfDomain, $newString);

	}
}
?>

<?php
function processExchangeRateAverage()
{
	$exchangeRates = $_REQUEST['exchangeRates'];
	//print ("Input string is: $exchangeRates <br><br>");
	
	$exchangeRatesArray = split("\n", $exchangeRates);
	
	$avgToUSA = 0.0;
	$avgToCanada = 0.0;
	$numExhRates = 0;
	foreach ($exchangeRatesArray as $exchRateData)
	{
		$numExhRates++;
		//print ("$exchRateData <br>");
		$exchRateData = preg_replace('/\t+/', ' ', $exchRateData);
		$parsedData = split(" ", $exchRateData);
		//foreach ($parsedData as $dataItem)
		//{
		//	print ("di $dataItem, ");
		//}
		//print "<br>";
	
		$exchRateToUSA = $parsedData[3];
		$exchRateToCanada = substr($parsedData[4], 1, $parsedData[4]-2);
		print "exchRateToUSA:$exchRateToUSA  and exchRateToCanada:$exchRateToCanada <br>";
		$avgToUSA = $avgToUSA + (float)$exchRateToUSA;
		$avgToCanada = $avgToCanada + (float)$exchRateToCanada;
		//print "avgToUSA:$avgToUSA  and avgToCanada:$avgToCanada <br><br>";
	
	}
	$avgToUSAis = $avgToUSA/$numExhRates;
	$avgToCanadais = $avgToCanada/$numExhRates;
	
	print ("avgToUSA is $avgToUSAis <br> avgToCanada is $avgToCanadais <br>");
}
?>

</body>
</html>
