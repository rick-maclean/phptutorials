
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Insert title here</title>
</head>
<body>

<h1>Reader.php outputs the Input from Form.html</h1>

<table border = 1>
<tr>
<th>FieldName</th>
<th>Value</th>
</tr>
<?php 
foreach ($_REQUEST as $field => $value)
{
	print <<<HERE
	<tr>
		<td>$field</td>
		<td>$value</td>
	</tr>
HERE;
}
?>
</table>
</body>
</html>