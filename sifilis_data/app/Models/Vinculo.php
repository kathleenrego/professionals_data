<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vinculo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data_atribuicao','cbo_id','vinculacao_id',
        'tipo_id','carga_horaria', 'profissional_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profissionais()
    {
        return $this->hasMany(Profissional::class,'vinculo_id', 'id');
    }
}
