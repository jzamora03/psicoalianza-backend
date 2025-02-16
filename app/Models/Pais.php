<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;

    protected $table = 'paises';
    protected $fillable = ['nombre'];

    public function ciudades()
    {
        return $this->hasMany(Ciudad::class, 'pais_id');
    }

    // Un país tiene varios empleados
    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'pais_id');
    }
}
