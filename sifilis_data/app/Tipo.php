<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profissionais()
    {
        return $this->hasMany(Profissional::class,'tipo_id', 'id');
    }
}
