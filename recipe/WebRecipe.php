<?php
namespace quanvm\convertepub\recipe;

class WebRecipe
{
    public static function create(string $name): ?IWebRecipe
    {
        if ($name == Bachngocsach::NAME) {
            return new Bachngocsach();
        }

        return null;
    }
}
