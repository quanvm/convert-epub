<?php
include_once 'simplehtmldom-repository/simple_html_dom.php';

$name = $argv[1];
$html = file_get_html("{$name}/mucluc.html");

foreach ($html->find('#page-title a') as $link) {
  echo $link->plaintext;

  break;
}

$html->clear();
unset($html);

?>
