<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Requests;

class Validation extends Model
{
    protected $fillable = ['request_id'];

    public function requestmodel()
{
    return $this->belongsTo(Requests::class, 'request_id');
}
}
