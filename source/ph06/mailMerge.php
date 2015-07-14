<html>
<head>
<title>Mailing List</title>
</head>
<body>
<form>


<?
//Simple Mail merge
//presumes tab-delimmited file called maillist.dat

$theData = file("maillist.dat");



foreach($theData as $line){
  $line = rtrim($line);
  print "<h3>$line</h3>";
  list($name, $email) = split("\t", $line);
  print "Name: $name";

  $message = <<<HERE
TO: $email:
Dear $name:

Thanks for being a part of the spam afficianado forum.  You asked to
be notified whenever a new recipe was posted.  Be sure to check our web
site for the delicious 'spam flambe with white sauce and cherries' recipe.

Sincerely,

Sam Spam,
Host of Spam Afficianados.

HERE;


  print "<pre>$message</pre>";

} // end foreach




?>
</body>
</html>
