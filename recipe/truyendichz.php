<?php
namespace quanvm\convertepub\recipe;

use simplehtmldom\HtmlDocument;

class Truyendichz implements IWebRecipe
{
    const NAME = 'truyendichz';

    public function getUrl(): string
    {
        return "https://truyendichz.com/%s?page=%d#list-chapter";
    }

    public function getLogoUrl(): string
    {
        return "https://truyendichz.com/%s";
    }

    public function getSelectorList(): string
    {
        return '.list-chapter a';
    }

    public function getContentUrl(): string
    {
        return "%s";
    }

    public function removeKeywords(): array
    {
        return ['truyendichz.com'];
    }

    public function parseContent(HtmlDocument $content): string
    {
        $fileData = '<h1>' . $content->find('h2.lh-name-chapter', 0)->innertext . '</h1>';
        $fileData .= '<div>' . $content->find('#read-content', 0)->innertext . '</div>';

        return str_replace($this->removeKeywords(), '', $fileData);
    }

    public function parseLogo(HtmlDocument $content): string
    {
        return $content->find('.book-thum img', 0)->src;
    }

    public function parseTitle(HtmlDocument $content): string
    {
        return $content->find('h1.hl-name-book a', 0)->plaintext;
    }

    public function parsePage(HtmlDocument $content): int
    {
        $href = $content->find('.box-page-view a.page-link', -2)->href;
        $link = explode('page=', $href);
        return str_replace('#list-chapter', '', $link[1]);
    }
}
