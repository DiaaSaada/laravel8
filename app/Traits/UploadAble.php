<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use File;
/**
 * Trait UploadAble
 * @package App\Traits
 */
trait UploadAble
{
    public function uploadImageIfExist($request, $imageFieldName, $input, $folderPath) {

        if (!empty($request[$imageFieldName])) {
            $file = $request->file($imageFieldName);
            $imageName = $this->uploadOne($file, $folderPath);
            $input[$imageFieldName] = $imageName;
            return $input;
        }
        else {
            return $input;
        }

    }

    public function uploadMultipleImagesIfExist($request, $imageFieldName, $input, $folderPath) {



        if (!empty($request[$imageFieldName])) {
            $uploadedImages = '';
            $counter = 1;
            $maxUploads = config('sparaat.max_number_of_uploaded_image') > 0 ? config('sparaat.max_number_of_uploaded_image') : 1;

            foreach($request[$imageFieldName] as $image) {
                if($counter <= $maxUploads) {
                    $imageName = $this->uploadOne($image, $folderPath);
                    if($uploadedImages == '') {
                        $uploadedImages = $imageName;
                    } else {
                        $uploadedImages = $uploadedImages . ',' . $imageName;
                    }
                }
                else {
                    break;
                }
              $counter++;
            }

            $input[$imageFieldName] = $uploadedImages;

            return $input;
        }
        else {
            return $input;
        }

    }

    /**
     * @param UploadedFile $file
     * @param null $folder
     * @param string $disk
     * @param null $filename
     * @return false|string
     */
    public function uploadOne(UploadedFile $file, $folderPath = null)
    {

/*
        $currentDate =  date('Y') .'/'. date('m') .'/'. date('d');
        $path = $folderPath . $currentDate;

        $test  = $file->store($path, ['disk'=>'public'] );
        $test = request()->root() . \Storage::url($test);
*/
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();


        $imageName = uniqid() . '.' . $extension;
        $currentDate =  date('Y') .'/'. date('m') .'/'. date('d');
        $path = $folderPath . $currentDate;
        if(!File::exists($path)) {
            File::makeDirectory(public_path($path), 0755, true);
        }

        $path = public_path($path . '/' . $imageName);



        $img =  Image::make($file);
        $imageWidth =  $img->width();
        $imageHeight = $img->height();

        if($imageWidth > $imageHeight) {
            // resize the image to a defined width and constrain aspect ratio (auto height)
            $img->resize(256, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }
        else {
            // resize the image to a defined height and constrain aspect ratio (auto width)
            $img->resize(null, config('sparaat.uploaded_image_dimension.height'), function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }



        //$img->save($path,70);

        Storage::disk('public')->put($folderPath. $currentDate.'/'. $imageName, (string) $img->encode());

        return request()->root() . \Storage::url($folderPath . $currentDate .'/'. $imageName);

    }

    /**
     * @param null $path
     * @param string $disk
     */
    public function deleteOne($path = null, $disk = 'public')
    {
        $productImage = explode('/storage', $path);

        if (Storage::disk('public')->exists($productImage[1])) {
            return Storage::disk($disk)->delete($productImage[1]);
        }

    }

    public function deleteImages($deletedImages, $inputImages)
    {
        $deletedImages = explode(',', $deletedImages);
        $inputImages = explode(',', $inputImages);

        foreach ($deletedImages as $image) {
            if (($key = array_search($image, $inputImages)) !== false) {
                unset($inputImages[$key]);
            }
        }

        if (count($inputImages)) {
            $inputImages = implode(',', $inputImages);
        } else {
            $inputImages = null;
        }

        return $inputImages;

    }

    public function addImages($addedImages, $inputImages)
    {

        $addedImages = explode(',', $addedImages);
        if(!empty($inputImages)) {
            $inputImages = explode(',', $inputImages);
        } else {
            $inputImages = [];
        }

        foreach ($addedImages as $image) {
            $productImage = explode('/storage', $image);

            if (Storage::disk('public')->exists($productImage[1])) {
                array_push($inputImages, $image);
            }
        }

        if (count($inputImages)) {
            $inputImages = implode(',', $inputImages);
        } else {
            $inputImages = null;
        }


        return $inputImages;

    }
}
