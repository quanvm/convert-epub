<?php
namespace quanvm\convertepub\crawler;

use quanvm\convertepub\recipe\IWebRecipe;
use simplehtmldom\HtmlWeb;

class DownloadList
{
  public static function execute(string $name, int $page, IWebRecipe $recipe)
  {
    $doc = new HtmlWeb();
    $url = sprintf($recipe->getUrl(), $name, $page);
    $html = $doc->load($url);

    foreach ($html->find($recipe->getSelectorList()) as $key => $link) {
      $chap = 1000 + ($page*100 + $key);
      $filename = "data/{$name}/{$chap}.html";
      if (!file_exists($filename)) {
        $contentUrl = sprintf($recipe->getContentUrl(), $link->href);
        $content = $doc->load($contentUrl);

        if ($content) {
          $newContent = $recipe->parseContent($content);
          file_put_contents($filename, $newContent);

          $content->clear();
          unset($content);

          // Avoid websites block us :)
          sleep(5);
        } else {
          var_dump("Could not download $contentUrl");
        }
      }
    }

    $html->clear();
    unset($html);
  }
}
