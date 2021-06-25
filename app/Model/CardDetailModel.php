<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class CardDetailModel extends Model
{
    protected $table = 'card_detail';
    protected $fillable = [
        'patient_id'
    ];
}
