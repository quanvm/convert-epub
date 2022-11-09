<?php
include_once 'simplehtmldom-repository/simple_html_dom.php';

$name = $argv[1];
$html = file_get_html("{$name}/mucluc.html");

foreach ($html->find('.pager-last a') as $link) {
  $link = explode('page=', $link->href);
  echo $link[1];

  break;
}

$html->clear();
unset($html);

?>
