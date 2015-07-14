<html>
<head>
<title>imageIndex</title>
</head>
<body>

<?
// image index
// generates an index file containing all images in a particular directory

//point to whatever directory you wish to index.
//index will be written to this directory as imageIndex.html
$dirName = "c:/csci/mm";
$dp = opendir($dirName);
chdir($dirName);

//add all files in directory to $theFiles array
while ($currentFile !== false){
  $currentFile = readDir($dp);
  $theFiles[] = $currentFile;
} // end while

//extract gif and jpg images
$imageFiles = preg_grep("/jpg$|gif$/", $theFiles);

$output = "";
foreach ($imageFiles as $currentFile){
  $output .= <<<HERE
<a href = $currentFile>
  <img src = "$currentFile"
       height = 50
       width = 50>
</a>

HERE;

} // end foreach

//save the index to the local file system
$fp = fopen("imageIndex.html", "w");
fputs ($fp, $output);
fclose($fp);
//readFile("imageIndex.html");
print "<a href = $dirName/imageIndex.html>image index</a>\n";

 ?>
 
</body>
</html>
