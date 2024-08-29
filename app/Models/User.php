<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function jobs() {
        return $this->belongsToMany(Job::class,'users_jobs');
    }

    public function postedJobs(){
        return $this->hasMany(Job::class,'creator_id');
    }

    public function getFilteredUserInfo($appliedJob,$user,$job){
        $filteredContact = $appliedJob->contact()->where('user_id',$user->id)->where('job_id',$job->id)->first();
        $filteredExperiences = $appliedJob->experiences->filter(function ($experience) use ($user, $job) {
            return $experience->user_id == $user->id && $experience->job_id == $job->id;
        });
        $filteredEducations = $appliedJob->educations->filter(function ($education) use ($user, $job) {
            return $education->user_id == $user->id && $education->job_id == $job->id;
        });
        $filteredLanguages = $appliedJob->languages->filter(function ($language) use ($user, $job) {
            return $language->user_id == $user->id && $language->job_id == $job->id;
        });
        $filteredAdditional = $appliedJob->additional()->where('user_id',$user->id)->where('job_id',$job->id)->first();
    
        return [
            'job' => $job,
            'user' => $user,
            'contact' => $filteredContact,
            'experiences' => $filteredExperiences,
            'educations' => $filteredEducations,
            'languages' => $filteredLanguages,
            'additional' => $filteredAdditional,
        ];
    }
}
