<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class AppointmentModel extends Model
{
    protected $primaryKey = 'appointment_id';
    protected $table = 'appointments';

    public function payment()
    {
        return $this->hasOne(PaymentModel::class, 'transaction_id');
    }
}
