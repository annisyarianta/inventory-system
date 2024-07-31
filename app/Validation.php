<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    protected $fillable = ['request_id'];

    public function request()
    {
        return $this->belongsTo(requests::class);
    }

}
