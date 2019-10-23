<?php

namespace App\Http\Controllers\Api\Backend\Image;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Backend\Image\ImageRquest;
use Storage;
use App\Models\Image\Image;
use App\Libs\ImageUploadHandler;

class ImageController extends Controller
{
    public function store(ImageRquest $request,Image $image,ImageUploadHandler $uploader){
        $result = $uploader->save($request->images, $request->model);
        return $this->response()->array($result);
        $path = $request->file('images')->store('images', 'public');
        return $this->response()->json(['path' => Storage::disk('public')->url($path)]);
    }
}
