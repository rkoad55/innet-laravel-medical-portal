<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class PatientPastHistoryModel extends Model
{
    protected $table = 'patient_past_history';
    protected $fillable = [
        'patient_id'
    ];
    
}
