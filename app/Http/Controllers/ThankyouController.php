<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThankyouController extends Controller
{
    public function __invoke()
    {
        return inertia()->render('Thankyou');
    }
}
