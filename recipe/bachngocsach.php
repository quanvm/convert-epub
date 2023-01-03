<?php
namespace quanvm\convertepub\recipe;

use simplehtmldom\HtmlDocument;

class Bachngocsach implements IWebRecipe
{
    const NAME = 'bachngocsach';

    public function getUrl(): string
    {
        return "https://bachngocsach.com.vn/reader/%s/muc-luc?page=%d";
    }

    public function getLogoUrl(): string
    {
        return "https://bachngocsach.com.vn/reader/%s";
    }

    public function getSelectorList(): string
    {
        return '#mucluc-list a.chuong-link';
    }

    public function getContentUrl(): string
    {
        return "https://bachngocsach.com.vn%s";
    }

    public function removeKeywords(): array
    {
        return ['BachNgocSach.com', 'bachngocsach.com', 'Bachngocsach.com', 'sach.com', 'bachngocsach.com.vn'];
    }

    public function parseContent(HtmlDocument $content): string
    {
        $fileData = '<h1>' . $content->find('#chuong-title', 0)->innertext . '</h1>';
        $fileData .= '<div>' . $content->find('#noi-dung', 0)->innertext . '</div>';

        return str_replace($this->removeKeywords(), '', $fileData);
    }

    public function parseLogo(HtmlDocument $content): string
    {
        return $content->find('#anhbia img', 0)->src;
    }

    public function parseTitle(HtmlDocument $content): string
    {
        return $content->find('h1#truyen-title', 0)->plaintext;
    }

    public function parsePage(HtmlDocument $content): int
    {
        $href = $content->find('.pager-last a', 0)->href;
        $link = explode('page=', $href);
        return $link[1];
    }
}
