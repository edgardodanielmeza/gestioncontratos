<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoContrato extends Model
{
    protected $table = 'tipocontratos';
    protected $primaryKey = 'idtipocontrato';
    public $timestamps = true;

    // Relación con duraciones
    public function duracion()
    {
        return $this->belongsTo(duracion::class, 'duracion_contrato');
    }
}
