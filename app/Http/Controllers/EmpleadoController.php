<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Cargo;
use App\Models\Ciudad;
use App\Models\Pais;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $empleados = Empleado::paginate(4);
     //  $empleados = Empleado::with('cargos')->get();
        $empleados = Empleado::with(['ciudad', 'pais', 'cargos', 'jefe'])->paginate(10);
        $ciudades = Ciudad::all();
        $paises = Pais::all();
        $cargos = Cargo::all();
        $jefes = Empleado::whereHas('cargos', function ($query) {
            $query->where('nombre', '!=', 'Presidente');
        })->get();

        return view('empleados.index', compact('empleados', 'ciudades','paises', 'cargos', 'jefes'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Pais::all();
        $ciudades = Ciudad::all();
        $cargos = Cargo::all();
        $jefes = Empleado::whereNotNull('id')->get();
        return view('empleados.create', compact('paises', 'ciudades', 'cargos', 'jefes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
    $request->validate([
        'nombres' => 'required',
        'apellidos' => 'required',
        'identificacion' => 'required|unique:empleados',
        'direccion' => 'required',
        'telefono' => 'required',
        'pais_id' => 'required',
        'ciudad_id' => 'required',
        'jefe_id' => 'nullable|exists:empleados,id',
    ]);

    // Verificar si el jefe seleccionado es presidente
    if ($request->jefe_id) {
        $jefe = Empleado::find($request->jefe_id);
        if ($jefe && $jefe->cargos->contains('nombre', 'Presidente')) {
            return back()->withErrors(['jefe_id' => 'No puede asignar al Presidente como jefe.']);
        }
    }

    $empleado = Empleado::create($request->all());
    $empleado->cargos()->attach($request->cargos ?? []);

    return redirect()->route('empleados.index')->with('success', 'Empleado registrado correctamente.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)

    {
        return view('empleados.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $empleado = Empleado::where('id', $id)->first();
        /*$empleado = Empleado::all();*/
        $paises = Pais::all();
        $ciudades = Ciudad::all();
        $cargos = Cargo::all();
        $jefes = Empleado::whereNotNull('id')->get();
        return view('empleados.edit', compact('empleado', 'paises', 'ciudades', 'cargos', 'jefes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Empleado $empleado)
    {
    $request->validate([
        'nombres' => 'required',
        'apellidos' => 'required',
        'identificacion' => "required|unique:empleados,identificacion,$empleado->id",
        'direccion' => 'required',
        'telefono' => 'required',
        'pais_id' => 'required',
        'ciudad_id' => 'required',
        'jefe_id' => 'nullable|exists:empleados,id',
    ]);

    if ($request->jefe_id) {
        $jefe = Empleado::find($request->jefe_id);
        if ($jefe && $jefe->cargos->contains('nombre', 'Presidente')) {
            return back()->withErrors(['jefe_id' => 'No puede asignar al Presidente como jefe.']);
        }
    }
    if ($empleado->cargos->contains('nombre', 'Presidente') && $request->jefe_id) {
        return back()->withErrors(['jefe_id' => 'El Presidente no puede tener un jefe.']);
    }

    // Actualizar el empleado
    $empleado->update($request->all());
    $empleado->cargos()->sync($request->cargos ?? []);

    return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente.');
    }
}
