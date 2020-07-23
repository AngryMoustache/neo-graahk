<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;

class Attachment extends Model
{
    public $unlockCheck = false;

    protected $fillable = [
        'original_name',
        'alt_name',
        'path',
    ];

    public function getPath($format = null)
    {
        $url = $this->id . '/' . ($format ? $format . '-' : '') . $this->original_name;
        return Storage::disk($this->disk)->path($url);
    }

    public function format($format)
    {
        $path = $this->getPath();
        $formatPath = $this->getPath($format);
        $formatClass = 'App\\Formats\\' . ucfirst($format);

        if (!is_file($formatPath)) {
            $image = Image::load($path);
            $image = $formatClass::render($image);
            $image->save($formatPath);
        }

        $url = $this->id . '/' . ($format ? $format . '-' : '') . $this->original_name;
        return Storage::disk($this->disk)->url($url);
    }
}
