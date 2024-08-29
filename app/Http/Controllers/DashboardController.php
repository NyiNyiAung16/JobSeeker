<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {   
        $appliedJobs = null;
        $postedJobs = null;
        $users = null;
        $user = auth()->user();
        switch($user->role){
            case 'employee':
                $appliedJobs = $user->jobs()->orderBy('created_at', 'desc')->get();
                break;
            case 'employer':
                $postedJobs = $user->postedJobs()->orderBy('created_at', 'desc')->get();
                break;
            case 'admin':
                $users = User::latest()->get();
                break;
            default:
            break;
        };

        return inertia()->render('Dashboard',[
            'appliedJobs' => $appliedJobs,
            'postedJobs' => $postedJobs,
            'users' => $users
        ]);
    }
}
