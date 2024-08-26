<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class atkkeluar extends Model
{
    protected $table = 'atkkeluar';
    protected $fillable = ['masteratk_id', 'jumlahkeluar', 'tanggalkeluar', 'unit_id'];

    public function masteratk()
    {
        return $this->belongsTo(masteratk::class);
    }

    public function unit()
    {
        return $this->belongsTo(unit::class);
    }


}
