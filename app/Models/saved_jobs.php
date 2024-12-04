<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class saved_jobs extends Model
{
    //
    protected $table = 'saved_jobs';


    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function applicants()
    {
        return $this->hasMany(job_application::class, 'job_id');
    }

    public function getApplicantsCountAttribute()
    {
        return $this->applicants()->count();
    }
}
