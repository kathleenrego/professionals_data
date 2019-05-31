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

    protected $casts = [
        'data_atribuicao' => 'date:d/m/Y',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vinculacao()
    {
        return $this->belongsTo(Vinculacao::class, 'vinculacao_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'tipo_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profissional()
    {
        return $this->belongsTo(Profissional::class, 'profissional_id','id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cbo()
    {
        return $this->belongsTo(Cbo::class, 'cbo_id','id');
    }

}
