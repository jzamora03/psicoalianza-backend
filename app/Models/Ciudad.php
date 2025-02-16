<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;
<<<<<<< HEAD
    
=======

    protected $table = 'ciudades';
>>>>>>> nombre_temporal
    protected $fillable = ['nombre', 'pais_id'];

    public function pais()
    {
<<<<<<< HEAD
        return $this->belongsTo(Pais::class);
    }

    // Una ciudad tiene varios empleados
=======
        return $this->belongsTo(Pais::class, 'pais_id');
    }

>>>>>>> nombre_temporal
    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
