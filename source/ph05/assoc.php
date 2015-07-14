<!doctype html public "-//W3C//DTD HTML 4.0 //EN"> 
<html>
<head>
<title>Associative array demo</title>
</head>
<body>
<h1>Associative Array Demo</h1>
<?
$stateCap["Alaska"] = "Juneau";
$stateCap["Indiana"] = "Indianapolis";
$stateCap["Michigan"] = "Lansing";

print "Alaska: ";
print $stateCap["Alaska"];
print "<br><br>";

$worldCap = array(
  "Albania"=>"Tirana",
  "Japan"=>"Tokyo",
  "United States"=>"Washington DC"
  );

print "Japan: ";
print $worldCap["Japan"];
print "<br><br>";

foreach ($worldCap as $country => $capital){
  print "$country: $capital<br>\n";
} // end foreach

?>

</body>
</html>
