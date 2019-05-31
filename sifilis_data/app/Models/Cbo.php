<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cbo extends Model
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
    public function vinculos()
    {
        return $this->hasMany(Vinculo::class,'cbo_id', 'id');
    }

}
