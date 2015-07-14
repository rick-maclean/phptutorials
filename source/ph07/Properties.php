<?
include "SuperHTMLDef.php";
$s = new SuperHTML("Basic Super Page");
$s->setTitle("I changed this");
$s->buildTop();
print "The title is now " . $s->getTitle();
$s->buildBottom();
print $s->getPage();
?>




