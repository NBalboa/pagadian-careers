<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HiringManager extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'company_id', 'address_id'];



    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function company()
    {
        return $this->belongsTo(Company::class, "company_id");
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function jobs()
    {
        return $this->hasMany(Work::class, 'hiring_manager_id');
    }
}
