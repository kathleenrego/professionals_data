<?php

namespace App;

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
        'nome', 'cns', 'data_atribuicao','cbo_id','vinculo_id',
        'tipo_id','carga_horaria','sus',
    ];

    /**
     * Convert date fields to Carbon
     *
     * @var array
     */
    protected $dates = ['data_atribuicao'];


}
