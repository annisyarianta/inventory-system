<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lokasi extends Model
{
    protected $table = 'lokasi';
    protected $fillable = ['NamaLokasi'];

    public function inventory()
    {
        return $this->hasMany(inventory::class);
    }
}
