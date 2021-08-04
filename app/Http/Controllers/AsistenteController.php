<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistente;

class AsistenteController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asistentes = Asistente::all(); //Guardar todos los registros
        return view('asistente.index')->with('asistentes',$asistentes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('asistente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $asistentes = new Asistente();
        $asistentes->nombre = $request->get('nombre');
        $esSocio = $request->get('socio');
        $booleanEsSocio = 0;
        if( $esSocio == 'on'){
            $booleanEsSocio = 1;
        }
        $asistentes->socio = $booleanEsSocio;

        $asistentes->save();
        return redirect('/asistentes');
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
        $asistente = Asistente::find($id);

        return view('asistente.edit')->with('asistente', $asistente);
        
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
        $asistente = Asistente::find($id);

        $asistente->nombre = $request->get('nombre');
        $esSocio = $request->get('socio');
        $booleanEsSocio = 0;
        if( $esSocio == 'on'){
            $booleanEsSocio = 1;
        }
        $asistente->socio = $booleanEsSocio;

        $asistente->save();
        return redirect('/asistentes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asistente = Asistente::find($id);
        $asistente->delete();
        return redirect('/asistentes');
    }
}
