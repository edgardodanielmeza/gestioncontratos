<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';
    protected $primaryKey = 'idequipo';

    protected $fillable = [
        'idprovision',
        'fecha_provision',
        'serial',
        'mac',
    ];

    // Relación con el modelo ProvisionContrato
    public function provisionContrato()
    {
        return $this->belongsTo(ProvisionContrato::class, 'idprovision', 'idprovision');
    }
}
