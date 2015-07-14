<html>
<head>
<title>Cartoonify</title>
</head>
<body>
<?
$fileName = "sonnet76.txt";

$sonnet = file($fileName);
$output = "";

foreach ($sonnet as $currentLine){
  $currentLine = str_replace("r", "w", $currentLine);
  $currentLine = str_replace("l", "w", $currentLine);
  $output .= rtrim($currentLine) . "<br>\n";
} // end foreach
  $output .= "You wascally wabbit!<br>\n";

print $output;

?>
</body>
</html>
