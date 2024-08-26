<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class atkmasuk extends Model
{
    protected $table = 'atkmasuk';
    protected $fillable = ['masteratk_id', 'jumlahmasuk', 'tanggalmasuk', 'hargasatuan', 'hargatotal'];

    public function masteratk()
    {
        return $this->belongsTo(masteratk::class);
    }
}
