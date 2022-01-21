<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;
    protected $fillable = [
        'sr_pcode', 'sr_name_eng', 'district_pcode', 'district_name_eng', 'district_name_mmr'

    ];
}
