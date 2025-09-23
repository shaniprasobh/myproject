<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'company_id',
        'email',
        'mobile_number',
    ];

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }
}
