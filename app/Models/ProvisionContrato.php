<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvisionContrato extends Model
{
    protected $table = 'provisionescontratos';
    protected $primaryKey = 'idprovision';

    protected $fillable = [
        'idcontrato',
        'iditem',
        'cantidad_provision',
        'fecha',
        'duracion_garantia',
    ];

    // Relación con el modelo ContratoItem
    public function contratoItem()
    {
        return $this->belongsTo(ContratoItem::class, 'iditem', 'iditem');
    }

    // Relación con el modelo Contrato
    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'idcontrato', 'idcontrato');
    }






}
