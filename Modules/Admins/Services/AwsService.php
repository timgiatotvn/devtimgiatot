<?php

namespace Modules\Admins\Services;

use Illuminate\Support\Facades\Storage;

class AwsService
{
    public function storeImageToS3($path, $name)
    {
        if (!empty($path)) {
            \Storage::disk('s3')->put('photos/' . $name . '.jpg', fopen($path, 'r'));
            $s3 = \Storage::disk('s3')->getAdapter()->getClient();
            
            return $s3->getObjectUrl(env('AWS_BUCKET'), 'photos/' . str_slug($name) . '.jpg');
        } else {
            return NULL;
        }
    }
}