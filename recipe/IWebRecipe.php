<?php
namespace quanvm\convertepub\recipe;

use simplehtmldom\HtmlDocument;

interface IWebRecipe
{
    public function getUrl(): string;
    public function getLogoUrl(): string;
    public function getSelectorList(): string;
    public function getContentUrl(): string;
    public function removeKeywords(): array;
    public function parseContent(HtmlDocument $content): string;
    public function parseLogo(HtmlDocument $content): string;
    public function parseTitle(HtmlDocument $content): string;
    public function parsePage(HtmlDocument $content): int;
}
