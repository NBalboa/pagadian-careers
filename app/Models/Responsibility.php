<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsibility extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'description'
    ];

    public function job()
    {
        return $this->belongsTo(Work::class, 'work_id');
    }
}
