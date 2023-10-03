<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroEvento extends Model
{

    protected $table = 'registroeventos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'idcontrato',
        'evento',
        'descripcion',
        'fecha',
    ];


    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'idcontrato', 'idcontrato');
    }
}
