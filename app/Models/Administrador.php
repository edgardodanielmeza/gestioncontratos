<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Administrador extends Model
{
    protected $table = 'administradores';
    protected $primaryKey = 'idadministrador';
    public $timestamps = true;

    // Relación con contratos
    public function contratos()
    {
        return $this->hasMany('App\Contrato', 'idadministrador');
    }
}
