<?php

namespace App\Http\Controllers;

use Response;
use Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ApiController extends Controller {

    // Given variables
    private static $imageWidth = 362;
    private static $imageHeight = 544;
    private static $imagePaddingX = 10;
    private static $imagePaddingY = 10;
    private static $imageCountX = 5;
    private static $imageCountY = 2;

    public function get() {
        // Get all images from assets
        $images = Storage::disk('public')->files('assets');
        // Sort naturally (e.g. so 1.png is followed by 2.png not 10.png)
        sort($images, SORT_NATURAL);
    
        return response()->json(['images' => $images]);
    }

    public function generate() {
        // Get all images
        $images = self::get()->original['images'];

        // Get collage sizes
        $collageWidth = self::$imageCountX * self::$imageWidth + ((self::$imageCountX - 1) * self::$imagePaddingX);
        $collageHeight = self::$imageCountY * self::$imageHeight + ((self::$imageCountY - 1) * self::$imagePaddingY);

        // Create collage image
        $collage = Image::canvas($collageWidth, $collageHeight);

        foreach($images as $key => $image) {
            // Get image offset based on key
            $xOffset = ((int)$key % self::$imageCountX) * (self::$imageWidth + self::$imagePaddingX);
            $yOffset = floor((int)$key / self::$imageCountX) * (self::$imageHeight + self::$imagePaddingY);

            // Add image to collage
            $collage->insert($image, 'top-left', $xOffset, $yOffset);
        }

        // Create path if it doesn't exist
        $path = 'generated';
        $fileName = 'result.png';
        $fullPath = $path . '/' . $fileName;
        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 777, true);
        }

        // Save collage to server
        $collage->save($fullPath);

        // Return path to collage
        return response()->json(['path' => $fullPath]);
    }
}
