<?php
include_once 'simplehtmldom-repository/HtmlWeb.php';
use simplehtmldom\HtmlWeb;

$name = $argv[1];
$page = $argv[2] ?? 0;
$url="https://bachngocsach.com/reader/{$name}/muc-luc?page={$page}";

$doc = new HtmlWeb();
$html = $doc->load($url);

foreach ($html->find('#mucluc-list a.chuong-link') as $key => $link) {
  $chap = 1000 + ($page*100 + $key);
  $filename = "{$name}/{$chap}.html";
  if (!file_exists($filename)) {
    $contentUrl = "https://bachngocsach.com" . $link->href;
    $content = $doc->load($contentUrl);

    if ($content) {
      $fileData = '<h1>' . $content->find('#chuong-title', 0)->innertext . '</h1>';
      $fileData .= '<div>' . $content->find('#noi-dung', 0)->innertext . '</div>';
      $newContent = str_replace(['BachNgocSach.com', 'bachngocsach.com', 'Bachngocsach.com'], '', $fileData);
      file_put_contents($filename, $newContent);

      $content->clear();
      unset($content);
      sleep(10);
    } else {
      var_dump($content, $contentUrl);
    }
  }
}

$html->clear();
unset($html);

?>
