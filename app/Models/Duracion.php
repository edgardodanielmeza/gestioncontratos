<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duracion extends Model
{
    protected $table = 'duraciones';
    protected $primaryKey = 'idduracion';
    public $timestamps = true;

    // Relación con tipo de contratos
    public function tipoContratos()
    {
        return $this->hasMany('App\TipoContrato', 'duracion_contrato');
    }
}
