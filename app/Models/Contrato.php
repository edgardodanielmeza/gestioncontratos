<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;





class Contrato extends Model
{
    protected $table = 'contratos';
    protected $primaryKey = 'idcontrato';
    public $timestamps = true;
    protected $fillable = [
        'descripcion',
        'alias',
        'idtipocontrato',
        'idadministrador',
        'fechafirma',
        'idcontratista',
        'anho',
        'idContrataciones',
        'idmonto',
        'fechainicio',
        'fecha_ARTP',
        'fecha_ARTD',
    ];

    // Relación con administradores
    public function administrador()
    {

        return $this->belongsTo(Administrador::class, 'idadministrador');
    }

    // Relación con contratistas
    public function contratista()
    {
        return $this->belongsTo(Contratista::class, 'idcontratista');
    }

    // Relación con tipo de contrato
    public function tipoContrato()
    {
        return $this->belongsTo(TipoContrato::class, 'idtipocontrato');
    }

    // Relación con contratos fiscales
    public function fiscales()
    {
        return $this->belongsToMany(Fiscal::class, 'contratofiscales', 'idcontrato', 'idfiscal');
    }

    // Relación con items
    public function items()
    {
        return $this->belongsTo('App\Item', 'contratoitem', 'idcontrato', 'iditem');
    }




    public function contratoItems()
    {
        return $this->hasMany(ContratoItem::class, 'idcontrato', 'idcontrato');
    }


public function provisiones()
{
    return $this->hasMany(ProvisionContrato::class, 'idcontrato', 'idcontrato');
}

// Método para obtener la cantidad de provisiones asociadas a este contrato
public function getCantidadProvisionesAttribute()
{
    return $this->provisiones()->count();
}
public function equipos()
{
    return $this->hasManyThrough(Equipo::class, ProvisionesContrato::class, 'idcontrato', 'idprovision', 'idcontrato', 'idprovision');
}

public function eventos()
{
    return $this->hasMany(RegistroEvento::class, 'idcontrato', 'idcontrato');
}

}
