<?php

namespace App\Http\Controllers\Voyager\ContentTypes;

use TCG\Voyager\Http\Controllers\ContentTypes\Image as BaseImage;
use Yish\Imgur\Facades\Upload as Imgur;

class Image extends BaseImage
{
    public function handle()
    {
        if ($this->request->hasFile($this->row->field)) {
            $file  = $this->request->file($this->row->field);
            $image = Imgur::upload($file);
            return $image->link();
        }
    }
}
