<?
include "SuperHTMLDef.php";
$s = new SuperHTML("Creating Tables");
$s->buildTop();

$s->h3("build table from 2d array");
$myArray = array(
  array("English", "Spanish", "Japanese"),
  array("One", "Uno", "Ichi"),
  array("Two", "Dos", "Nii"),
  array("Three", "Tres", "San")
);
$s->buildTable($myArray);

$s->h3("build table row-by-row");
$s->startTable(3);
$s->tRow(array("English", "Greek"), "th");
$s->tRow(array("a", "alpha"));
$s->tRow(array("b", "beta"));
$s->endTable();

$s->buildBottom();
print $s->getPage();
?>




