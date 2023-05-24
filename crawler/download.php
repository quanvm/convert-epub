<?php
namespace quanvm\convertepub\crawler;

require_once __DIR__ . '/../vendor/autoload.php';

use quanvm\convertepub\recipe\WebRecipe;

$name = $argv[1];
$page = $argv[2];
$recipeName = $argv[3];
$total = $argv[4];
$recipe = WebRecipe::create($recipeName);
DownloadLogo::execute($name, $recipe);
DownloadList::execute($name, $page, $recipe, $total);
