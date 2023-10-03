<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratista extends Model
{
    protected $table = 'contratistas';
    protected $primaryKey = 'idcontratista';
    public $timestamps = true;

    // Relación con contratos
    public function contratos()
    {
        return $this->hasMany('App\Contrato', 'idcontratista');
    }
}
