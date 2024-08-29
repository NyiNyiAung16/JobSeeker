<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    use HasFactory;

    protected $cast = [
        'worked_before_here' => 'boolean',
        'legally_work' => 'boolean',
        'agreed_terms' => 'boolean'
    ];

    public function job() {
        return $this->belongsTo(Job::class);
    }
    
    public function getLegallyWorkAttribute(){
        return (bool) $this->attributes['legally_work'];
    }

    public function getWorkedBeforeHereAttribute(){
        return (bool) $this->attributes['worked_before_here'];
    }
}
