<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobDetailsController extends Controller
{
    public function __invoke(Job $job)
    {   
        return inertia()->render('Jobs/JobDetails',[
            'job' => $job,
            'similarJobs' => Job::where('status','approved')->get()->random(3),
            'appliedJobsId' => auth()->user()?->jobs->pluck('id')->all()
        ]);
    }
}
