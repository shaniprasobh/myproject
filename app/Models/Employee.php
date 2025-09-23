<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'name',
        'email',
        'mobile_number',
        'landline_number',
        'address',
        'country_id',
        'state_id',
        'location',
        'profile_picture',
        'employee_code',
        'designation_id',
        'department_id',
        'doj',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
