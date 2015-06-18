<?php

namespace Spartz;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function cities()
    {
        return $this->hasMany('Spartz\City');
    }
}