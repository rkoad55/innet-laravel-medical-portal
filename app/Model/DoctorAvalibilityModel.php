<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class DoctorAvalibilityModel extends Model
{

    protected $fillable = ['doctor_id'];
    protected $table = 'doctor_avalibility';
}
