<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerRejectedJobsController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $rejectedJobs = $user->postedJobs()->where('status','rejected')->orderBy('created_at', 'desc')->paginate(5);

        return inertia()->render('Employer/RejectedJobs',compact('rejectedJobs'));
    }
}
