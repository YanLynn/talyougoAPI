<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'company_logo',
        'company_name',
        'company_email',
        'company_phone',
        'company_reg_number',
        'city_sr_pcode',
        'township_tw_code',
        'company_address',

    ];
    protected $hidden = ['created_at', 'updated_at'];
}
