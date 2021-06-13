<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\UploadAble;

class ImageUploadController extends Controller
{

    use UploadAble;

    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'images' => 'nullable|array',
          'images.*' => 'nullable|image|mimes:jpeg,jpg|max:10240'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()]);
        }

        if (!empty($request['images'])) {

            foreach($request['images'] as $key => $image) {
              if($image->getClientOriginalExtension() === "jfif") {
                  return response()->json(['success' => false, 'message' => 'Cannot upload images of type jfif']);
              }
            }

            $uploadedImages = [];
            $counter = 1;
            $maxUploads = config('sparaat.max_number_of_uploaded_image') > 0 ? config('sparaat.max_number_of_uploaded_image') : 1;

            foreach($request['images'] as $key => $image) {
                if($counter <= $maxUploads) {
                  $uploadedImages[] = $this->uploadOne($image, config('sparaat.images_folder_path'));
                }
                else {
                    break;
                }
              $counter++;
            }
            return response()->json(['success' => true, 'images' => $uploadedImages]);
        } else {
          return response()->json(['success' => false, 'images' => [] ]);
        }
    }
}
