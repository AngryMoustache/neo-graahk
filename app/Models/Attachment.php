<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Image\Image;

class Attachment extends Model
{
    public $unlockCheck = false;

    protected $fillable = [
        'original_name',
        'alt_name',
        'disk',
    ];

    public function getPath($format = null)
    {
        $url = $this->id . '/' . ($format ? $format . '-' : '') . $this->original_name;
        return Storage::disk($this->disk)->path($url);
    }

    public function path()
    {
        return Storage::disk($this->disk)
            ->url($this->id . '/' . $this->original_name);
    }

    public function format($format)
    {
        $path = $this->getPath();
        $formatPath = $this->getPath($format);
        $formatClass = 'App\\Formats\\' . ucfirst($format);

        if (in_array(Str::afterLast($path, '.'), ['svg', 'gif'])) {
            $url = $this->id . '/' . $this->original_name;
            return Storage::disk($this->disk)->url($url);
        }

        if (!is_file($formatPath)) {
            $image = Image::load($path);
            $image = $formatClass::render($image);
            $image->save($formatPath);
        }

        $url = $this->id . '/' . ($format ? $format . '-' : '') . $this->original_name;
        return Storage::disk($this->disk)->url($url);
    }

    public static function lubeUpload($file)
    {
        if (!is_file($file->getRealPath())) {
            return null;
        }

        $original = $file->getClientOriginalName();

        if ($reupload = Attachment::where('original_name', $original)->first()) {
            return $reupload;
        }

        $attachment = self::create([
            'original_name' => $original,
            'alt_name' => $original,
            'disk' => 'public'
        ]);

        Storage::putFileAs(
            "public/attachments/{$attachment->id}/",
            $file->getRealPath(),
            $file->getClientOriginalName()
        );

        return $attachment;
    }
}
