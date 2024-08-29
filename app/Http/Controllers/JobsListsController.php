<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use App\Models\Location;
use Illuminate\Http\Request;

class JobsListsController extends Controller
{
    public function __invoke(Request $request)
    {
        $filters = $request->query();

        return inertia()->render('Jobs/JobsLists',[
            'jobs' => Job::filter($filters)->where('status','approved')->paginate(6),
            'appliedJobsId' => auth()->user()?->jobs->pluck('id')->all(),
            'locations' => Location::all(),
            'categories' => Category::all(),
            'jobTypes' => JobType::all(),
            'jobsLength' => Job::all()->count()
        ]);
    }
}
