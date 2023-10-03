<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Fiscal extends Model
{
    protected $table = 'fiscales';
    protected $primaryKey = 'idfiscal';
    public $timestamps = true;

    // Relación con contratos fiscales
    public function contratos()
    {
        return $this->belongsToMany(Contrato::class, 'contratofiscales', 'idfiscal', 'idcontrato');
    }
}
