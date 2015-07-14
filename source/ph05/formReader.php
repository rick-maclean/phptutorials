<!doctype html public "-//W3C//DTD HTML 4.0 //EN"> 
<html>
<head>
       <title>Form Reader</title>
</head>
<body>
<h1>Form Reader</h1>
<h3>Here are the fields I found on the form</h3>
<?
print <<<HERE
<table border = 1>
<tr>
  <th>Field</th>
  <th>Value</th>
</tr>
HERE;

foreach ($_REQUEST as $field => $value){
  print <<<HERE
  <tr>
    <td>$field</td>
    <td>$value</td>
  </tr>
HERE;
} // end foreach
print "</table>\n";

?>

</body>
</html>
