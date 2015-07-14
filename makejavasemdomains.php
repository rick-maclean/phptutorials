<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Convert to PigLatin</title>
</head>
<body>

<h1>Exchange Rate Average</h1>
<?php
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
	/*foreach ($parsedData as $dataItem)
	{
		print ("di $dataItem, ");
	}
	print "<br>";
	*/
	$exchRateToUSA = $parsedData[3];
	$exchRateToCanada = substr($parsedData[4], 1, $parsedData[4]-2);
	print "exchRateToUSA:$exchRateToUSA  and exchRateToCanada:$exchRateToCanada <br>";
	$avgToUSA = $avgToUSA + (float)$exchRateToUSA;
	$avgToCanada = $avgToCanada + (float)$exchRateToCanada;
	//print "avgToUSA:$avgToUSA  and avgToCanada:$avgToCanada <br><br>";
	
}
$avgToUSAis = $avgToUSA/$numExhRates;
$avgToCanadais = $avgToCanada/$numExhRates;

print ("avgToUSA is $avgToUSAis <br> avgToCanada is $avgToCanadais <br>")
?>



</body>
</html>
