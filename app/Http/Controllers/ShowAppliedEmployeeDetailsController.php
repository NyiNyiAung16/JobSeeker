<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class ShowAppliedEmployeeDetailsController extends Controller
{
    public function __invoke(User $user,Job $job)
    {
        $appliedJob = $user->jobs->filter(function($j) use($job) {
            if($j->id === $job->id){
                return true;
            }
            return false;
        })->first();

        $employeeDetails = (object) $user->getFilteredUserInfo($appliedJob,$user,$job);
        return inertia()->render('Employer/AppliedDetails',compact('employeeDetails'));
    }
}
