<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // Si la tabla no usa el nombre plural de forma predeterminada (es decir, "items"),
    // puedes especificar el nombre de la tabla explícitamente:
    protected $table = 'items';

    // Si la tabla no tiene las columnas 'created_at' y 'updated_at', puedes deshabilitar el manejo de marcas de tiempo:
    public $timestamps = true;

    // Especificar qué atributos pueden ser asignados en masa
    protected $fillable = [
        'name', 
        'description'
    ];

    // Si la columna 'id' no es la clave primaria, puedes especificar otra:
    // protected $primaryKey = 'your_custom_primary_key';
}
