<?php

namespace App\Transformers\Image;

use League\Fractal\TransformerAbstract;
use App\Models\Image\Image;
class ImageTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Image $image)
    {
        return [
            'id' => $image->id,
            'model' => $image->model,
            'model_id' => $image->model_id,
            'path' => $image->path,
            'created_at' => $image->created_at->toDateTimeString(),
            'updated_at' => $image->updated_at->toDateTimeString(),
        ];
    }
}
