<html>
<head>
<title>LoadSonnet</title>
<style type = "text/css">
body{
  background-color:darkred;
  color:white;
  font-family:'Brush Script MT', script;
  font-size:20pt
}
</style>

</head>
<body>
<?
$fp = fopen("sonnet76.txt", "r");

//first line is title
$line = fgets($fp);
print "<center><h1>$line</h1></center>\n";

print "<center>\n";
//print rest of sonnet
while (!feof($fp)){
  $line = fgets($fp);
  print "$line <br>\n";
} // end while

print "</center>\n";

fclose($fp);

?>

</body>
</html>
