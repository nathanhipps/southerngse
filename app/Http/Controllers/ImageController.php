<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function show($path)
    {
        if ($file = Storage::get($path)) {
            $file = Storage::get($path);
            $type = Storage::mimeType($path);
            return response()->make($file, 200)->header("Content-Type", $type);
        }

        return response('', 404);
    }
}
