<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'code',
        'address',
        'zip',
        'state_id',
        'country_id',
        'email',
        'mobile_number',
        'landline_number',
        'website',
        'gst_number',
    ];
}
