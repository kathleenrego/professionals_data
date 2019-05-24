<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'cns', 'data_atribuicao','cbo_id','vinculo_id',
        'tipo_id','carga_horaria','sus',
    ];

}
