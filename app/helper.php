<?php

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use MathPHP\Finance;

if (!function_exists('saveImageInFolder')) {
    /**
     * Save image
     *
     * @param  UploadedFile  $image
     * @param $folderName
     * @param  bool  $update
     * @param  null  $imageName
     * @return array|null
     */
    function saveImageInFolder(UploadedFile $image, $folderName, $update = false, $imageName = null)
    {
        try {
            $imageName = $update ? $imageName : $image->hashName();
            Storage::disk('public')->put('/' . $folderName . '/', $image);
            $imageResize = resizeImage(getimagesize($image));
            Image::make($image->path())->resize($imageResize[FLAG_ZERO], $imageResize[FLAG_ONE])
                ->save(storage_path('/app/public/' . $folderName . '/' . THUMBNAIL_IMAGE_FIRST_NAME . $imageName));
            return [
                'avatar' => $imageName,
                'avatar_thumbnail' => THUMBNAIL_IMAGE_FIRST_NAME . $imageName
            ];
        } catch (\Exception $exception) {
            report($exception);
            return null;
        }
    }
}
