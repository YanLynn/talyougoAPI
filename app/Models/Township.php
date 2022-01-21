<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    use HasFactory;
    protected $fillable = [
        'sr_code', 'd_code', 'ts_code', 'tw_code', 'tw_name_eng', 'tw_name_mmr'

    ];
}
