<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('public/images');

            return response()->json([
                'imageUrl' => Storage::url($path)
            ]);
        }

        return response()->json([
            'imageUrl' => 'looix'
        ]);
    }
}
