<?php
require_once __DIR__ . '/../vendor/autoload.php';

use quanvm\convertepub\recipe\Bachngocsach;
use simplehtmldom\HtmlWeb;

$name = $argv[1];
$recipeName = $argv[2];

if ($recipeName == Bachngocsach::NAME) {
    $recipe = new Bachngocsach();
}

$doc = new HtmlWeb();
$url = sprintf($recipe->getUrl(), $name, 0);
$html = $doc->load($url);
echo $recipe->parsePage($html);

$html->clear();
unset($html);
