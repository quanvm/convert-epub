<?php
namespace quanvm\convertepub\crawler;

use quanvm\convertepub\recipe\IWebRecipe;
use simplehtmldom\HtmlWeb;

class DownloadList
{
  public static function execute(string $name, int $page, IWebRecipe $recipe, int $total)
  {
    if (self::isDownloaded($name, $page, $total)) {
      return;
    }

    $doc = new HtmlWeb();
    $url = sprintf($recipe->getUrl(), $name, $page);
    $html = $doc->load($url);

    foreach ($html->find($recipe->getSelectorList()) as $key => $link) {
      $chapNumber = ($page*100 + $key);
      $chap = 1000 + $chapNumber;
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

      echo "Downloading ... $chapNumber/$total \r";
    }

    $html->clear();
    unset($html);

    sleep(1);
  }

  public static function isDownloaded(string $name, int $page, $total)
  {
    $isDownloaded = true;
    $key = 0;
    while ($key < 100) {
      $chapNumber = ($page*100 + $key);
      $chap = 1000 + $chapNumber;
      $filename = "data/{$name}/{$chap}.html";
      if ($chapNumber >= $total) {
        break;
      }

      if (!file_exists($filename)) {
        $isDownloaded = false;
        break;
      }

      $key++;
    }

    return $isDownloaded;
  }
}
