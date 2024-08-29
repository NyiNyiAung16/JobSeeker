<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobStoreRequest;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JobStoreController extends Controller
{
    public function __invoke(JobStoreRequest $request)
    {
        sleep(2);
        $cleanData = $request->validated();
        $path = $request->file('image_url')->store('public/images');
        $url = Storage::url($path);
        $cleanData['image_url'] = $url;
        $cleanData['creator_id'] = auth()->id();
        Job::create($cleanData);
        return back()->with('message',[
            'type' => 'success',
            'body' => 'Job created successfully.'
        ]);
    }
}
