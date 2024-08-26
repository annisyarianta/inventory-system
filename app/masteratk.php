<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class masteratk extends Model
{
    protected $table = 'masteratk';
    protected $fillable = ['namabarang', 'kodebarang', 'jenisbarang', 'satuan', 'gambar'];

    public function atkmasuk()
    {
        return $this->hasMany(atkmasuk::class);
    }

    public function atkkeluar()
    {
        return $this->hasMany(atkkeluar::class);
    }

    public function getGambar()
    {
        if (!$this->gambar) {
            return asset('assets/img/ATKPuraTrack.png');
        }

        return asset('images/' . $this->gambar);
    }

}
