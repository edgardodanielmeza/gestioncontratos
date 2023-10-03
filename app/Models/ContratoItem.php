<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class ContratoItem extends Model
{
    protected $table = 'contratoitems';
    protected $primaryKey = 'id';

    protected $fillable = [
        'idcontrato',
        'iditem',
        'cantidad_minima',
        'cantidad_maxima',
        'descripcion',
        'precio',
    ];

    // Relación con el modelo Contrato
    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'idcontrato', 'idcontrato');
    }

    // Relación con el modelo Item
    public function item()
    {
        return $this->belongsTo(Item::class, 'iditem', 'iditem');
    }

    public function contratoItem()
    {
        return $this->belongsTo(ContratoItem::class, 'iditem', 'iditem');
    }


      // Relación con el modelo ProvisionContrato
      public function provisiones()
      {
          return $this->hasMany(ProvisionContrato::class, 'iditem', 'iditem');
      }

      // Método para obtener la cantidad de provisiones asociadas a este item de contrato
      public function getCantidadProvisionesAttribute()
      {
          return $this->provisiones()->sum('cantidad_provision');
      }
}
