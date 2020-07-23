<?php

namespace App\Formats;

use Spatie\Image\Image;

class Card extends Format
{
    public static function render(Image $image)
    {
        return $image->crop('crop-center', 500, 700);
    }
}
