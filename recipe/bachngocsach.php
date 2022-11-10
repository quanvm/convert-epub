<?php
namespace quanvm\convertepub\recipe;

use simplehtmldom\HtmlDocument;

class Bachngocsach implements WebRecipe
{
    const NAME = 'bachngocsach';

    public function getUrl()
    {
        return "https://bachngocsach.com/reader/%s/muc-luc?page=%d";
    }

    public function getSelectorList()
    {
        return '#mucluc-list a.chuong-link';
    }

    public function getContentUrl()
    {
        return "https://bachngocsach.com%s";
    }

    public function removeKeywords()
    {
        return ['BachNgocSach.com', 'bachngocsach.com', 'Bachngocsach.com', 'sach.com'];
    }

    public function parseContent(HtmlDocument $content)
    {
        $fileData = '<h1>' . $content->find('#chuong-title', 0)->innertext . '</h1>';
        $fileData .= '<div>' . $content->find('#noi-dung', 0)->innertext . '</div>';

        return str_replace($this->removeKeywords(), '', $fileData);
    }
}
