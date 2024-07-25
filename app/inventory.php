<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    protected $table = 'barang';
    protected $fillable = ['nama', 'ok', 'us', 'lokasi_id', 'gambar', 'keterangan'];

    public function lokasi()
    {
        return $this->belongsTo(lokasi::class);
    }

    public function getGambar()
    {
        if (!$this->gambar) {
            return asset('images/gambar-default-null.png');
        }

        return asset('images/' . $this->gambar);
    }
}
