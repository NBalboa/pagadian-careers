<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = ['user_id',  'address_id', 'profile', 'gender'];

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'applicant_skills');
    }

    public function educations()
    {
        return $this->belongsToMany(Education::class, 'applicant_educations')
            ->withPivot('from', 'to', 'school_name', 'id');
    }
}
