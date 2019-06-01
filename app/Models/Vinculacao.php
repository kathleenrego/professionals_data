<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vinculacao extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vinculacoes';
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
        return $this->hasMany(Vinculo::class,'vinculacao_id', 'id');
    }
}
