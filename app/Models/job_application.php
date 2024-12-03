<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class job_application extends Model
{
    //
    protected $table = 'job_application';



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
