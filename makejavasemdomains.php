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
$semDomainsOdometer = array (0,0,0,0,0,0);

//processFromTextBox();

processFromFile();

//foreach ($roots as $root){
//	print "$root <br>";
//}

//$treeLevel = 0;



?>

<?php 
function processFromFile()
{
	 $file = fopen("SemDomainsSena3Copy.txt","r");
	 while (!feof($file))
	 {
		 $currentSemDomain = fgets($file);
		 //print "$currentSemDomain<br>";
		 $parsedData = split(" ", $currentSemDomain);
		 $domainNumber = $parsedData[0];
		 $levelOfDomain = substr_count("$domainNumber","-") + 1;
		 
		 buildTreeToSupportThisItem($domainNumber, $levelOfDomain);
		 
		 $domainNumberModified = preg_replace('/-/', '.', $domainNumber) . '.';
		 $newString = "$domainNumberModified" . substr($semanticDomain, strlen($domainNumber), strlen($semanticDomain));
		 outputSemDomAsJava($levelOfDomain, $newString);
	 }
	 fclose($file); 
}

function buildTreeToSupportThisItem($domainNumber, $levelOfDomain)
{
	global $semDomainsOdometer;
	//First insert the standard tree root element if it is needed here.
	printRootDomainIfNeeded($domainNumber);
	$domainDigits = split('-', $domainNumber);
	$levelToPrint = array($semDomainsOdometer[0],0,0,0,0,0);
	print '$semDomainsOdometer:'. $semDomainsOdometer[0] .'<br>';
	print '$domainNumber:'. $domainNumber .'<br>'; 
	print '   $levelOfDomain:'. $levelOfDomain .'<br>';
	print '   $levelToPrint:';
	foreach ($levelToPrint as $digit)
	{
		print $digit . '.';
	}
	print '<br>';
	
	for ($i=0; $i<$levelOfDomain-1; $i++)
	{
		print '    $domainDigits[i]:'. (string)$domainDigits[i] . '    $semDomainsOdometer[i]:'. (string)$semDomainsOdometer[i] . '<br>'; 
		if ($domainDigits[i] > $semDomainsOdometer[i])
		{
			$levelToPrint[i] = $domainDigits[i];
			for ($j=0; $j<i; $j++)
			{
				$strPrint = $levelToPrint[i] . '.';
			}
			outputSemDomAsJava($i, $strPrint);
		}
	}

}

function printRootDomainIfNeeded($domainNumber)
{
	global $semDomainsOdometer;
	global $rootDomainPrinted;
	global $roots;
	$rootDomain = substr($domainNumber, 0, 1);
	//print "rootDomain:$rootDomain rootDomainPrinted:$rootDomainPrinted[$rootDomain] ";
	if ("$rootDomainPrinted[$rootDomain]" =="no")
	{
		print "$roots[$rootDomain] <br>";
		$rootDomainPrinted[$rootDomain] = "yes";
		
		$semDomainsOdometer = array($rootDomain,0,0,0,0);
		//print '   $semDomainsOdometer(all):';
		//foreach ($semDomainsOdometer as $digit)
		//{
		//	print $digit . '.';
		//}
		//print '<br>';
	}
}

function outputSemDomAsJava($levelOfDomain, $newString)
{
	$levelMinus1 = (string)$levelOfDomain-1;
	print 'aux' . (string)$levelOfDomain . '= insFld(aux' . $levelMinus1 . ', gFld("';
    print "$newString";
	print '", "c1000.htm"))<br>';
	
	/*
	switch($levelOfDomain)
	{
		case 2:
			print 'aux2 = insFld(aux1, gFld("';
			print "$newString";
			print '", "c1000.htm"))<br>';
			break;
		case 3:
			print 'aux3 = insFld(aux2, gFld("';
			print "$newString";
			print '", "c1000.htm"))<br>';
			break;
		case 4:
			print 'aux4 = insFld(aux3, gFld("';
			print "$newString";
			print '", "c1000.htm"))<br>';
			break;
		case 5:
			print 'aux5 = insFld(aux4, gFld("';
			print "$newString";
			print '", "c1000.htm"))<br>';
			break;
		default:
			print "$newString";
			print "Something went wrong <br>";
	}
	*/
	
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
