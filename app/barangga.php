<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barangga extends Model
{
    protected $table = 'barangga';
    protected $fillable = ['namabarang', 'kodebarang', 'jenisbarang', 'satuan', 'gambar'];

    public function masukga()
    {
        return $this->hasMany(masukga::class);
    }

    public function keluarga()
    {
        return $this->hasMany(keluarga::class);
    }

    public function getGambar()
    {
        if (!$this->gambar) {
            return asset('assets/img/ATKPuraTrack.png');
        }

        return asset('images/' . $this->gambar);
    }

}
