<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function __invoke()
    {
        $aboutUsContent = Content::where('type','about_us')->first();
        $content = $aboutUsContent?->body;

        return inertia()->render('About-Us',compact('content'));
    }
}
