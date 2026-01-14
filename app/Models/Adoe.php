<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adoe extends Model
{
    protected $table = 'adoes';

    protected $fillable = [
        'nome_animal', 'tipo', 'raca', 'idade', 'sexo',
        'nome_usuario', 'email_usuario', 'telefone',
        'termo_aceito', 'assinatura', 'termo_aceito_em',
        'status', 'decisao_em',
    ];

    protected $casts = [
        'termo_aceito' => 'boolean',
        'termo_aceito_em' => 'datetime',
        'decisao_em' => 'datetime',
    ];
}
