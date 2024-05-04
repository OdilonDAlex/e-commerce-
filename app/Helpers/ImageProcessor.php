<?php

namespace App\Helpers;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Interfaces\ImageInterface;

class ImageProcessor {

    public function __construct(
        public string $imageDir,
        public string|int|float $width,
        public string|int|float $height,
        public string $dir
    )
    {
        $this->process();
    }

    public function process(): ImageInterface|null{
        $imageManager = new ImageManager(new Driver()); 

        /** @var ImageInterface $image */
        $image = $imageManager->read($this->imageDir);

        try {
            return $image->scaleDown(1000, 675);
        }
        catch(Exception $e) {
            // 
        }

        dd($image);
    } 
}