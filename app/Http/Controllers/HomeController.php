<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {

        $jobsLength = count(Job::all());
        $partnersLength = count(Partner::all());

        return inertia()->render('Home',[
            'jobs' => Job::where('status','approved')->latest()->limit(3)->get(),
            'partners' => Partner::latest()->get(),
            'appliedJobsId' => auth()->user()?->jobs->pluck('id')->all(),
            'jobsLength' => $jobsLength,
            'partnersLength' => $partnersLength
        ]);
    }
}
