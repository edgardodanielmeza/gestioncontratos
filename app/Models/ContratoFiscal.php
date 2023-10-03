<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ContratoFiscal extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'contratofiscales';

    // Definición de la clave primaria compuesta
    protected $primaryKey = ['idcontrato', 'idfiscal'];

    // Indicar a Laravel que las claves no son autoincrementales
    public $incrementing = false;

    // Campos que pueden ser llenados masivamente (si aplica)
    protected $fillable = [
        'idcontrato',
        'idfiscal',
        // Otros campos si es necesario
    ];

    // Relación con el modelo Contrato
    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'idcontrato', 'idcontrato');
    }

    // Relación con el modelo Fiscal
    public function fiscal()
    {
        return $this->belongsTo(Fiscal::class, 'idfiscal', 'idfiscal');
    }
}
