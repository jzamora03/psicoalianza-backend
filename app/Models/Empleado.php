<?php

namespace App\Models;

use App\Models\Ciudad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $fillable = ['nombres', 'apellidos', 'identificacion', 'direccion', 'telefono', 'ciudad_id', 'jefe_id', 'activo'];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function jefe()
    {
        return $this->belongsTo(Empleado::class, 'jefe_id');
    }

    public function colaboradores()
    {
        return $this->hasMany(Empleado::class, 'jefe_id');
    }

    public function cargos()
    {
        return $this->belongsToMany(Cargo::class, 'empleado_cargo');
    }
}
