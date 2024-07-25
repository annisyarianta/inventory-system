<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    protected $table = 'unit';
    protected $fillable = ['namaunit'];

    public function keluarga()
    {
        return $this->hasMany(keluarga::class);
    }
}
