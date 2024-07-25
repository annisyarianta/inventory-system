<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class masukga extends Model
{
    protected $table = 'masukga';
    protected $fillable = ['barangga_id', 'jumlahmasuk', 'tanggalmasuk'];

    public function barangga()
    {
        return $this->belongsTo(barangga::class);
    }
}
