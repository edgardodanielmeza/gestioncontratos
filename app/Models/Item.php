<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'iditem';

    protected $fillable = [
        'descripcionitem',
    ];

    // Relación con el modelo ContratoItem
    public function contratoItems()
    {
        return $this->hasMany(ContratoItem::class, 'iditem', 'iditem');
    }
}
