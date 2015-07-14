<?
include "SuperHTMLDef.php";
$s = new SuperHTML("Basic Super Page");
$s->buildTop();
$s->buildBottom();
print $s->getPage();
?>




