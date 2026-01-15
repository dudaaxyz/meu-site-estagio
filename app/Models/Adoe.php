<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adoe extends Model
{
    use HasFactory;

    protected $table = 'adoes';

    protected $fillable = [
        'user_id',
        'animal_id',
        'status',
        'data_adocao',
        'decisao_em',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }
}
