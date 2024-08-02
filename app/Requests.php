<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $fillable = ['barangga_id', 'quantity', 'unit_id', 'tanggal_request', 'status'];

    public function barangga()
    {
        return $this->belongsTo(barangga::class);
    }

    public function unit()
    {
        return $this->belongsTo(unit::class);
    }

    // Di dalam model Request
    public function validation()
    {
        return $this->belongsTo(Validation::class);
    }

}
