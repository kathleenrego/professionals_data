<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profissionais';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'cns', 'sus', 'carga_horaria_total',
    ];

    /**
     * Convert date fields to Carbon
     *
     * @var array
     */
    protected $dates = ['data_atribuicao'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vinculos()
    {
        return $this->hasMany(Vinculo::class,'profissional_id', 'id');
    }

}
