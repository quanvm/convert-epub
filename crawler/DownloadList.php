<?php
namespace quanvm\convertepub\crawler;

use simplehtmldom\HtmlWeb;

class DownloadList
{
  public static function execute(string $name, int $page)
  {
    $doc = new HtmlWeb();
    $url="https://bachngocsach.com/reader/{$name}/muc-luc?page={$page}";
    $html = $doc->load($url);

    foreach ($html->find('#mucluc-list a.chuong-link') as $key => $link) {
      $chap = 1000 + ($page*100 + $key);
      $filename = "data/{$name}/{$chap}.html";
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
          var_dump("Could not download $contentUrl");
        }
      }
    }

    $html->clear();
    unset($html);
  }
}