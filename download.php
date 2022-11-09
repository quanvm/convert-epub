<?php
require_once __DIR__ . '/vendor/autoload.php';

use quanvm\convertepub\crawler\DownloadList;

$name = $argv[1];
$page = $argv[2] ?? 0;
DownloadList::execute($name, $page);
