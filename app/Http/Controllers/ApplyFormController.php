<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobApplicationRequest;
use App\Models\Job;
use Illuminate\Support\Facades\Storage;

class ApplyFormController extends Controller
{
    public function get(Job $job)
    {
        return inertia()->render('Jobs/ApplyForm',[
            'job' => $job,
        ]);
    }

    protected function addUserId($array,$user_id){
        return array_map(function($a) use($user_id) {
            $a['user_id'] = $user_id;
            return $a;
        },$array);
    }

        public function store(Job $job,JobApplicationRequest $request) {
            $cleanData = $request->validated();        
            if($request->hasFile('additional.resume')){
                $path = $request->file('additional.resume')->store('public/resumes');
                $url = Storage::url($path);
                $cleanData['additional']['resume_file_path'] = $url;
                unset( $cleanData['additional']['resume']);
            }
            $user_id = auth()->id();
            $cleanData['contact']['user_id'] = $user_id;
            $cleanData['experiences'] = $this->addUserId($cleanData['experiences'],$user_id);
            $cleanData['education'] = $this->addUserId($cleanData['education'],$user_id);
            $cleanData['language'] = $this->addUserId($cleanData['language'],$user_id);
            $cleanData['additional']['user_id'] = $user_id;
            $job->contact()->create($cleanData['contact']);
            $job->experiences()->createMany($cleanData['experiences']);
            $job->educations()->createMany($cleanData['education']);
            $job->languages()->createMany($cleanData['language']);
            $job->additional()->create($cleanData['additional']); 
            $job->users()->attach($user_id); 
            return redirect('/thankyou')->with('message',[
                'type' => 'success',
                'body' => "Job Applied is successful."
            ]);     
        }
}
