<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    protected $table = 'unit';
    protected $fillable = ['namaunit'];

    public function atkkeluar()
    {
        return $this->hasMany(atkkeluar::class);
    }
}
