<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobType;
use App\Models\Location;
use Illuminate\Http\Request;

class JobCreateController extends Controller
{
    public function __invoke()
    {
        return inertia()->render('Employer/JobCreator',[
            'locations' => Location::get('name'),
            'categories' => Category::get('type'),
            'jobTypes' => JobType::get('name')
        ]);
    }
}
