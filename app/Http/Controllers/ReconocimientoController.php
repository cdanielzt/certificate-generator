<?php

namespace App\Http\Controllers;

use App\Mail\ReconocimientoMail;
use PDF;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Reconocimiento;
use App\Models\Design;
use App\Models\Curso;
use App\Models\AsistenciaCurso;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
        $designs = Design::orderBy('id', 'desc')->get();
        $cursos = Curso::orderBy('id', 'desc')->paginate(3);
        $asistencias = AsistenciaCurso::all();
        return view('reconocimiento.create', compact('designs', 'cursos', 'asistencias'));
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
                $reconocimiento->cliente_id = $asistente->cliente_id;
                $reconocimiento->razon = $request->razon;
                $reconocimiento->curso_id = $request->curso;
                $reconocimiento->fecha = $request->fecha;
                $reconocimiento->design_id = $request->design;
                $reconocimiento->save();
                $this->savePDF($reconocimiento);
                $this->sendEmail($reconocimiento->id);
            }
        } else {
            foreach ($request->cliente_id as $cliente_id) {
            $reconocimiento = new Reconocimiento();
            $reconocimiento->otorga = $request->otorga;
            $reconocimiento->tipo = $request->tipo;
            $reconocimiento->cliente_id = $cliente_id;
            $reconocimiento->razon = $request->razon;
            $reconocimiento->curso_id = $request->curso;
            $reconocimiento->fecha = $request->fecha;
            $reconocimiento->design_id = $request->design;
            $reconocimiento->save();
            $this->savePDF($reconocimiento);
            $this->sendEmail($reconocimiento->id);
            }
        }

        return redirect('reconocimientos');
    }

    public function savePDF($reconocimiento)
    {

        $content = $this->getPDF($reconocimiento->id)->download()->getOriginalContent();

        Storage::put("public/pdf/{$this->getFileName($reconocimiento)}", $content);
    }

    public function getFileName($reconocimiento)
    {
        return $reconocimiento->codigo . '-' . $reconocimiento->cliente->nombre . '.pdf';
    }

    public function getPDF($id)
    {
        $reconocimiento = Reconocimiento::find($id);
        $opciones_ssl = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
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

        return $pdf;
    }


    /**
     * Download the specified document.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $reconocimiento = Reconocimiento::find($id);
        return $this->getPDF($id)->download($this->getFileName($reconocimiento));
        // Guardar los pdf generados para poder enviarlos por correo
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reconocimiento = Reconocimiento::find($id);
        return $this->getPDF($id)->stream($this->getFileName($reconocimiento));
    }

    public function sendEmail($id)
    {
        $reconocimiento = Reconocimiento::find($id);
        $email = $reconocimiento->cliente->email;
        $pdf = $this->getPDF($reconocimiento->id)->output();
        if ($email) {
            Mail::to($email)->send(new ReconocimientoMail($id,$pdf));
        }
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
        if($reconocimiento){
            $this->deleteFile($reconocimiento);
            $reconocimiento->delete();
        }
        return redirect('/reconocimientos');
    }

    public function deleteFile($reconocimiento){
        $file ="public/pdf/{$this->getFileName($reconocimiento)}";
        if (Storage::delete($file)) {
            echo "Eliminado";
        } else {
            echo "File does not exist";
        }
    }
}
