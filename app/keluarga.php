<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keluarga extends Model
{
    protected $table = 'keluarga';
    protected $fillable = ['barangga_id', 'jumlahkeluar', 'tanggalkeluar', 'unit_id'];

    public function barangga()
    {
        return $this->belongsTo(barangga::class);
    }

    public function unit()
    {
        return $this->belongsTo(unit::class);
    }
}
