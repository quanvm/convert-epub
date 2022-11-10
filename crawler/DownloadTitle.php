<?php
require_once __DIR__ . '/../vendor/autoload.php';

use quanvm\convertepub\recipe\WebRecipe;
use simplehtmldom\HtmlWeb;

$name = $argv[1];
$recipeName = $argv[2];

$recipe = WebRecipe::create($recipeName);

$doc = new HtmlWeb();
$url = sprintf($recipe->getLogoUrl(), $name);
$html = $doc->load($url);
echo $recipe->parseTitle($html);

$html->clear();
unset($html);
