<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Pais;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciudades = Ciudad::paginate(6);
        $paises = Pais::all();

        return view('ciudades.index', compact('ciudades', 'paises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Pais::all();
        return view('ciudades.create', compact('paises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required', 'pais_id' => 'required']);
        Ciudad::create($request->all());
        return redirect()->route('ciudades.index')->with('success', 'Ciudad registrada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)

    {
        $paises = Pais::all();
        return view('ciudades.edit', compact('ciudad', 'paises'));
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ciudad = Ciudad::find($id); // Buscar la ciudad en la base de datos

        if (!$ciudad) {
            return redirect()->route('ciudades.index')->with('error', 'Ciudad no encontrada.');
        }
    
        $paises = Pais::all();
        return view('ciudades.edit', compact('ciudad', 'paises'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ciudad = Ciudad::findOrFail($id);
        $ciudad->update($request->all());

        return redirect()->route('ciudades.index')->with('success', 'Ciudad actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
        public function destroy($id)
        {
            $ciudad = Ciudad::findOrFail($id);
            $ciudad->delete();

            return redirect()->route('ciudades.index')->with('success', 'Ciudad eliminada correctamente.');
        }

    public function ciudadesPorPais($paisId)
    {
        $ciudades = Ciudad::where('pais_id', $paisId)->get();
    
        if ($ciudades->isEmpty()) {
            return response()->json([]);
        }
    
        return response()->json($ciudades);
    }



}
