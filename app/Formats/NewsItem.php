<?php

namespace App\Formats;

use Spatie\Image\Image;

class NewsItem extends Format
{
    public static function render(Image $image)
    {
        return $image->crop('crop-center', 250, 350);
    }
}
