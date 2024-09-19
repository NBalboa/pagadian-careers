<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'company_name', 'start', 'end', 'year', 'description'];
    public function applicant()
    {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }
}
