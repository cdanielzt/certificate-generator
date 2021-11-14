<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Reconocimiento;
use App\Models\Design;
use App\Models\Curso;
use App\Models\AsistenciaCurso;
use Carbon\Carbon;

class ReconocimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reconocimientos = Reconocimiento::all(); //Guardar todos los registros
        return view('reconocimiento.index')->with('reconocimientos', $reconocimientos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $design = Design::orderBy('id', 'desc')->get();
        $cursos = Curso::orderBy('id', 'desc')->paginate(3);
        $asistencias = AsistenciaCurso::all();
        return view('reconocimiento.create')->with('cursos', $cursos)->with('designs', $design)->with('asistencias', $asistencias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->todos_clientes == "on") {

            $asistencia = AsistenciaCurso::where('curso_id', '=', $request->curso)->get();
            foreach ($asistencia as $asistente) {
                $reconocimiento = new Reconocimiento();
                $reconocimiento->otorga = $request->otorga;
                $reconocimiento->tipo = $request->tipo;

                $reconocimiento->cliente_id = $asistente->id;

                $reconocimiento->razon = $request->razon;
                $reconocimiento->curso_id = $request->curso;
                $reconocimiento->fecha = $request->fecha;
                $reconocimiento->design_id = $request->design;

                $reconocimiento->save();
            }
        } else {
            $reconocimiento = new Reconocimiento();
            $reconocimiento->otorga = $request->otorga;
            $reconocimiento->tipo = $request->tipo;

            $reconocimiento->cliente_id = $request->cliente_id;

            $reconocimiento->razon = $request->razon;
            $reconocimiento->curso_id = $request->curso;
            $reconocimiento->fecha = $request->fecha;
            $reconocimiento->design_id = $request->design;
            $reconocimiento->save();
        }

        return redirect('reconocimientos');
    }


    /**
     * Download the specified document.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        dd($id);
        $reconocimiento = Reconocimiento::find($id);
        $meses = array(
            "01"  => "Enero",
            "02"  => "Febrero",
            "03"  => "Marzo",
            "04"  => "Abril",
            "05"  => "Mayo",
            "06"  => "Junio",
            "07"  => "Julio",
            "08"  => "Agosto",
            "09"  => "Septiembre",
            "10"  => "Octubre",
            "11"  => "Noviembre",
            "12"  => "Diciembre",
        );
        $fecha = $reconocimiento->fecha;
        list($año, $mes, $dia) = explode('-', $fecha);
        $reconocimiento->fecha = $dia . ' de ' . $meses[$mes] . ' de ' . $año;
        $pdf = PDF::loadView('pdf.fet', compact('reconocimiento'))->setOptions(
            [
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true
            ]
        )
            ->setPaper('letter', 'landscape')
            ->setWarnings(true);

        return $pdf->download($reconocimiento->codigo . '-' . $reconocimiento->cliente->nombre . '.pdf');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $opciones_ssl=array(
            "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
            ),
            );
        $reconocimiento = Reconocimiento::find($id);
        $img_path = 'storage/' . $reconocimiento->design->imagen;
        $extencion = pathinfo($img_path, PATHINFO_EXTENSION);
        $data = file_get_contents($img_path, false, stream_context_create($opciones_ssl));
        $img_base_64 = base64_encode($data);
        $image = 'data:image/' . $extencion . ';base64,' . $img_base_64;

        $meses = array(
            "01"  => "Enero",
            "02"  => "Febrero",
            "03"  => "Marzo",
            "04"  => "Abril",
            "05"  => "Mayo",
            "06"  => "Junio",
            "07"  => "Julio",
            "08"  => "Agosto",
            "09"  => "Septiembre",
            "10"  => "Octubre",
            "11"  => "Noviembre",
            "12"  => "Diciembre",
        );
        $fecha = $reconocimiento->fecha;
        list($año, $mes, $dia) = explode('-', $fecha);
        $reconocimiento->fecha = $dia . ' de ' . $meses[$mes] . ' de ' . $año;
        $pdf = PDF::loadView('pdf.fet', compact('reconocimiento', 'image'))->setOptions(
            [
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true
            ]
        )
            ->setPaper('letter', 'landscape')
            ->setWarnings(true);
        return $pdf->stream($reconocimiento->codigo . '-' . $reconocimiento->cliente->nombre . '.pdf');
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
    public function destroy($id)
    {
        $reconocimiento = Reconocimiento::find($id);
        $reconocimiento->delete();

        return redirect('/reconocimientos');
    }
}
