<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class ShowAppliedEmployeesController extends Controller
{
    public function __invoke(){

        $postedJobsWithUsers = auth()->user()->postedJobs()->with('users')->get();
        $appliedEmployeesInfo = $postedJobsWithUsers->filter(function ($job) {
            return $job->users->isNotEmpty();
        })->map(function ($job) {
            return $job->users->map(function ($user) use ($job) {
                return $user->getFilteredUserInfo($job,$user,$job);
            });
        })->flatten(1);
        return inertia()->render('Employer/AppliedEmployees',compact('appliedEmployeesInfo'));
    }
}
