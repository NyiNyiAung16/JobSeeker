<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class EmployerDestroyJobController extends Controller
{
    public function __invoke(Job $job)
    {
        $job->delete();
        $message = [
            'type' => 'success',
            'body' => 'Delete Job is successful.'
        ];
        return back()->with('message',$message);
    }
}
