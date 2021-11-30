<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsistenciaRequest;
use App\Models\AsistenciaCurso;

class AsistenciaCursoController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AsistenciaRequest $request)
    {
        $validated = $request->validated();

        
        
        foreach($request->input('cliente_id') as $cliente_id){
            $asistencia = new AsistenciaCurso();
            if( !(AsistenciaCurso::where('curso_id',$request->curso_id)->where('cliente_id',$cliente_id)->exists()) ){
                $asistencia->cliente_id = $cliente_id;
                $asistencia->curso_id = $request->curso_id;
                $asistencia->save();
            }
        }
        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AsistenciaRequest $request, $id)
    {
   

        $validated = $request->validated();

        $asistencia = AsistenciaCurso::find($id);
  
        foreach($request->input('cliente_id') as $cliente_id){
            $asistencia->cliente_id = $cliente_id;
            $asistencia->curso_id = $request->curso_id;
            $asistencia->save();
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asistente = AsistenciaCurso::find($id);

        $asistente->delete();
        return redirect()->back();
    }
}
