<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobWithDrawController extends Controller
{
    public function __invoke(Job $job)
    {
        $userId = auth()->id();
        $job->users()->detach($userId);
        
        return back()->with('message',[
            'type' => 'success',
            'body' => "Job Withdraw is successful."
        ]); 
    }
}
