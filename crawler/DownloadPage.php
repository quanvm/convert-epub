<?php
require_once __DIR__ . '/../vendor/autoload.php';

use quanvm\convertepub\recipe\WebRecipe;
use simplehtmldom\HtmlWeb;

$name = $argv[1];
$recipeName = $argv[2];

$recipe = WebRecipe::create($recipeName);

$doc = new HtmlWeb();
$url = sprintf($recipe->getUrl(), $name, 1);
$html = $doc->load($url);
$page = $recipe->parsePage($html);

$html->clear();
unset($html);

$url = sprintf($recipe->getUrl(), $name, $page);
$html = $doc->load($url);
$total = count($html->find($recipe->getSelectorList()));

$html->clear();
unset($html);

echo "$page $total";
