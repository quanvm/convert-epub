<?php
namespace quanvm\convertepub\recipe;

use simplehtmldom\HtmlDocument;

interface WebRecipe
{
    public function getUrl();
    public function getLogoUrl();
    public function getSelectorList();
    public function getContentUrl();
    public function removeKeywords();
    public function parseContent(HtmlDocument $content);
    public function parseLogo(HtmlDocument $content);
}
