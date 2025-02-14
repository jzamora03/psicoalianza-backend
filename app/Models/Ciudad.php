<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre', 'pais_id'];

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    // Una ciudad tiene varios empleados
    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
