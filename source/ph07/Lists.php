<?
include "SuperHTMLDef.php";
$s = new SuperHTML("Creating Lists");
$s->buildTop();

$myArray =array( "alpha", "beta", "gamma", "delta");

$s->h3("build an ordered list");
$s->buildList($myArray, "ol");

$s->h3("unordered lists are the default");
$s->buildList(array("alpha", "beta", "gamma", "delta"));

$s->h3("specify list type");
$s->buildList($myArray, "ol type = 'a'");

$s->buildBottom();
print $s->getPage();
?>




