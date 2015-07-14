<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html>
<head>
<title>Critter</title>
</head>
<body>
<?
// BASIC OOP DEMO

//define the critter class
class Critter{
  var $name;
} // end Critter class

//make an instance of the critter
$theCritter = new Critter();

//assign a value to the name property
$theCritter->name = "Andrew";

//return the value of the name property
print "My name is ";
print $theCritter->name;

?>
</body>
</html>




