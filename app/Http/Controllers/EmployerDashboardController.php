<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerDashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $pendingJobs = $user->postedJobs()->where('status','pending')->orderBy('created_at', 'desc')->paginate(5);
        return inertia()->render('Employer/Dashboard',compact('pendingJobs'));
    }
}
