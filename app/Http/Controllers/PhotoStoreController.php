<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoStoreRequest;
use Illuminate\Support\Facades\Storage;

class PhotoStoreController extends Controller
{
    public function __invoke(PhotoStoreRequest $request)
    {
        $cleanData = $request->validated();
        $path = $cleanData['image']->store('images','public');
        $url = Storage::url($path);
        return response()->json(['url' => $url ]);
    }
}
