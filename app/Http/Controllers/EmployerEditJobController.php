<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobStoreRequest;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployerEditJobController extends Controller
{
    public function  show(Job $job)
    {
        $locations = Location::all();
        $categories = Category::all();
        $jobTypes = JobType::all();

        return inertia()->render('Employer/EditJob',compact('job','locations','categories','jobTypes'));
    }

    public function update(Job $job,JobStoreRequest $request)
    {
        $cleanData = $request->validated();
        $status = $job->status; 

        if($job->image_url !== $cleanData['image_url']){
            $path = $request->file('image_url')->store('public/images');
            $url = Storage::url($path);
            $cleanData['image_url'] = $url;
            Storage::delete($job->image_url);
        }

        if($status === 'approved' || $status === 'rejected'){
            $job->status = 'pending';

            if($status === 'rejected'){
                $job->rejection_reason = '';
            }
        } 

       $job->update($cleanData);
       return redirect('/employer/dashboard')->with('message',[
        'type' => 'success',
        'body' => 'Job updated successfully.'
       ]);
    }
}
