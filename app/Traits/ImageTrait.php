<?php

namespace App\Traits;

use Intervention\Image\ImageManagerStatic as Image;
use File;

trait ImageTrait
{
    public function uploadImageToStorageDisk ($image)
    {
        $logo = time() . '_' . uniqid() . '.' . $image->extension(); // Generate a unique filename
        \Storage::disk('public')->put('images/' . date('d-m-Y') . '/' . $logo, file_get_contents($image));
        return 'images/' . date('d-m-Y') . '/' . $logo;

    }

    public function uploadImage($image): string
    {
        $logo = time() + random_int(0, 999) . '.' . $image->extension();
        $image->move(('images') . '/' . date('d-m-Y'), $logo);
        return '/images/' . date('d-m-Y') . '/' . $logo;
    }

    public function uploadFile($file): string
    {
        $logo = time() + random_int(0, 999) . '.' . $file->extension();
        $file->move(('files') . '/' . date('d-m-Y'), $logo);
        return '/files/' . date('d-m-Y') . '/' . $logo;
    }

    public function deleteImage($image_path): void
    {
        if (!empty($image_path)) {
            $path = public_path($image_path);

            $isExists = File::exists($path);

            if ($isExists) {
                unlink(public_path() . $image_path);
            }
        }
    }

    public function changeResolution($image,int $width, int $height ): string
    {
        $image_name = time() + random_int(0, 999) . '.' . $image->extension();

        $destinationPath = public_path('/images'.'/'. date('d-m-Y'));

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 755, true);
        }

        $img = Image::make($image->getRealPath());
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $image_name);

        return '/images/' . date('d-m-Y') . '/' . $image_name;
    }

    public function compress_image($image):string
    {

        $image_name = time() + random_int(0, 999) . '.' . $image->extension();

        $destinationPath = public_path('/images'.'/'. date('d-m-Y'));

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 755, true);
        }

        $img = Image::make($image->getRealPath());
        $img->encode($image->extension(), 50);
        $img->save($destinationPath . '/' . $image_name);

        return '/images/' . date('d-m-Y') . '/' . $image_name;

    }

}
