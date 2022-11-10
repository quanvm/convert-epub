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
echo $recipe->parsePage($html);

$html->clear();
unset($html);
