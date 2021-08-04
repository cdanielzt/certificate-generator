<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\CursoRequest;
use App\Models\Curso;
use App\Models\Cliente;
use App\Models\AsistenciaCurso;
class CursoController extends Controller
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
        $curso = Curso::all(); //Guardar todos los registros
        return view('curso.index')->with('cursos',$curso);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('curso.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CursoRequest $request)
    {

        $validated = $request->validated();

        $curso = new Curso();

        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $destinationPath ='images/cursos/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('imagen')->move($destinationPath, $filename);
            $curso->imagen =  $destinationPath . $filename;
        }

        $curso->nombre = $request->nombre;
        $curso->ponente = $request->ponente;
        $curso->descripcion = $request->descripcion;

        $curso->save();
        return redirect('/cursos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Curso::find($id);
        $clientes = Cliente::all();
        $asistencia = AsistenciaCurso::where('curso_id',"=",$id)->count();

        return view('curso.view')->with('curso', $curso)->with('clientes',$clientes)->with('asistencia',$asistencia);
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
    public function update(CursoRequest $request, $id)
    {
        $validated = $request->validated();

        $curso = Curso::find($id);

        if($request->hasFile('imagen')){
            $file = $request->file('imagen');
            $destinationPath ='images/cursos/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('imagen')->move($destinationPath, $filename);
            $curso->imagen =  $destinationPath . $filename;
        }

        $curso->nombre = $request->nombre;
        $curso->ponente = $request->ponente;
        $curso->descripcion = $request->descripcion;

        $curso->save();
        return redirect('/cursos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
