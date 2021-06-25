<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class PatientMentalHealthModel extends Model
{
    protected $table = 'patient_mental_health';
    protected $fillable = [
        'patient_id'
    ];
    
}
