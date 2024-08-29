<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function __invoke()
    {
        $privacy = Content::where('type','privacy')->first();
        $content = $privacy?->body  ;

        return inertia()->render('Privacy',compact('content'));
    }
}
