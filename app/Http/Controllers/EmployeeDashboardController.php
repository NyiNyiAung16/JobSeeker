<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $appliedJobs = $user->jobs()->orderBy('created_at', 'desc')->paginate(6);
        
        return inertia()->render('Employee/Dashboard',compact('appliedJobs'));
    }
}
