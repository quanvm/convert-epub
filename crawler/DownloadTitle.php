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
$url = sprintf($recipe->getLogoUrl(), $name);
$html = $doc->load($url);
echo $recipe->parseTitle($html);

$html->clear();
unset($html);
