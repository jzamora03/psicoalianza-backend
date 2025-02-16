<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paises = Pais::all();
        return view('paises.index', compact('paises'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paises.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required|unique:paises']);
        Pais::create($request->all());
        return redirect()->route('paises.index')->with('success', 'País registrado correctamente.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('paises.edit', compact('pais'));

        return view('paises.edit', compact('paises'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Pais $pais)
    {
        $request->validate(['nombre' => "required|unique:paises,nombre,$pais->id"]);
        $pais->update($request->all());
        return redirect()->route('paises.index')->with('success', 'País actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pais $pais)
    {
        $pais->delete();
        return redirect()->route('paises.index')->with('success', 'País eliminado correctamente.');
    }
}
