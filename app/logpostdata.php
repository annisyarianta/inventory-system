<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class logpostdata extends Model
{
    protected $table = 'logpostdatas';
    protected $fillable = ['log_id', 'log_date', 'log_uri', 'log_metadata', 'log_method'];
}
