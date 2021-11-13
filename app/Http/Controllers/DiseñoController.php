<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Design;
use Illuminate\Support\Facades\Storage;

class DiseñoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $design = Design::orderBy('id','desc')->paginate(4);
        return view('designs.index')->with('designs', $design);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $design = new Design();
        if($request->hasFile('imagen')){
            $fileName = 'design-'.time().'.'.$request->file('imagen')->getClientOriginalExtension();
            $design->imagen = $request->file('imagen')->storeAs('posts',$fileName,'public');
        }

        $design->nombre = $request->nombre;

        $design->save();
        return back()->with('status','Creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('diseños.square');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Design $design)
    {
        if(Storage::disk('public')->delete($design->imagen)){
            $design->delete();
        }
        return back()->with('status', 'Eliminando con éxito');

    }
 
}
