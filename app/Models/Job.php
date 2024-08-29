<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $table = '_jobs_';

    public function scopeFilter($query, $filter)
    {
        $filterable = [
            'position' => 'position',
            'category' => 'category',
            'location' => 'location',
            'jobType' => 'job_type',
            'sortByDate' => 'created_at'
        ];

        foreach ($filterable as $key => $column) {
            if (isset($filter[$key]) && $filter[$key] !== null) {
                if($column !== 'created_at'){
                    $query->where($column, 'LIKE', '%' . $filter[$key] . '%');
                }
            }
        }

        if (isset($filter['sortByDate']) && in_array(strtolower($filter['sortByDate']), ['asc', 'desc'])) {
            $query->orderBy('created_at', $filter['sortByDate']);
        }
    }

    public function users() {
        return $this->belongsToMany(User::class,'users_jobs');
    }

    public function experiences() {
        return $this->hasMany(Experience::class);
    }

    public function educations() {
        return $this->hasMany(Education::class);
    }

    public function languages() {
        return $this->hasMany(Language::class);
    }

    public function additional() {
        return $this->hasOne(Additional::class);
    }

    public function contact() {
        return $this->hasOne(Contact::class);
    }

    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at'])->diffForHumans(); 
    }
}

