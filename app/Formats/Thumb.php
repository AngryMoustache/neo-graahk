<?php

namespace App\Formats;

use Spatie\Image\Image;

class Thumb extends Format
{
    public static function render(Image $image)
    {
        return $image->crop('crop-center', 400, 400);
    }
}
