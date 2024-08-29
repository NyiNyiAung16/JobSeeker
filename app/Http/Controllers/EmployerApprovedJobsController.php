<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerApprovedJobsController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $approvedJobs = $user->postedJobs()->where('status','approved')->orderBy('created_at', 'desc')->paginate(5);

        return inertia()->render('Employer/ApprovedJobs',compact('approvedJobs'));
    }
}
