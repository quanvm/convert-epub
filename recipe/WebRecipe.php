<?php
namespace quanvm\convertepub\recipe;

class WebRecipe
{
    public static function create(string $name): ?IWebRecipe
    {
        if ($name == Bachngocsach::NAME) {
            return new Bachngocsach();
        }

        if ($name == Truyendichz::NAME) {
            return new Truyendichz();
        }

        return null;
    }
}
