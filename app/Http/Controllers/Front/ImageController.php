<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use League\Glide\Server;
use League\Glide\ServerFactory;


class ImageController extends Controller
{
    public function show($image_id, $size, $mode = 'fill')
    {

//        header('Content-Type: image/webp');

        if (in_array($mode, ['fill', 'stretch', 'crop', 'border']) === false) {
            abort(404);
        }

        $allowed_image_sizes = config('website.allowed_image_sizes');

        if (!isset($allowed_image_sizes[$size])) {
            abort(404);
        }

        $size = $allowed_image_sizes[$size];


        $image = Media::find($image_id);

        if (!$image) {
            abort(404);
        }

        $server = ServerFactory::create([
            'source' => storage_path('app/public/media'),
            'cache' => storage_path('app/public/cache'),
        ]);

        $size = explode('x', $size);

        $w = $size[0];
        $h = $size[1];

        $image = $server->makeImage( $image->name, ['w' => $w, 'h' => $h, 'fm' => 'webp', 'fit' => $mode]);
        $image = storage_path('app/public/cache/'.$image);

        return response()->file($image);

    }
    public function original_image($full_image_path){
        $path = 'app/public/'.$full_image_path;
        if (file_exists(storage_path($path)) === false) {
            abort(404);
        }
        return response()->file(storage_path($path));
    }
}
