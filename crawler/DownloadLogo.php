<?php
namespace quanvm\convertepub\crawler;

use quanvm\convertepub\recipe\IWebRecipe;
use simplehtmldom\HtmlWeb;

class DownloadLogo
{
  public static function execute(string $name, IWebRecipe $recipe)
  {
    $isLogo = glob("data/{$name}/logo.*");
    if (empty($isLogo)) {
      $doc = new HtmlWeb();
      $url = sprintf($recipe->getLogoUrl(), $name);
      $html = $doc->load($url);

      $logo = $recipe->parseLogo($html);
      if ($logo) {
          $content = file_get_contents($logo);
          $size = getimagesize($logo);
          $extension = image_type_to_extension($size[2]);
          $filename = "data/{$name}/logo{$extension}";
          file_put_contents($filename, $content);
      }

      $html->clear();
      unset($html);
    }
  }
}
