<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barangga extends Model
{
    protected $table = 'barangga';
    protected $fillable = ['namabarang', 'kodebarang', 'gambar'];

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
            return asset('images/Kopi Branti.png');
        }

        return asset('images/' . $this->gambar);
    }
}
