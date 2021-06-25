<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class CountryAndStatesModel extends Model
{
    protected $table = 'countries_states';

    public function state()
    {
        return $this->hasMany(self::class, 'child_id');
    }

    public function city()
    {
        return $this->hasMany(self::class, 'child_id', 'id')->with('state');
    }
}
