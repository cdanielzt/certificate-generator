<?php

namespace App\Mail;

use App\Models\Reconocimiento;
use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReconocimientoMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    protected $pdf;
    protected $fileName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
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

     
        $this->pdf = PDF::loadView('pdf.fet', compact('reconocimiento', 'image'))->setOptions(
            [
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true
            ]
        )
            ->setPaper('letter', 'landscape')
            ->setWarnings(true);
        $this->fileName = $reconocimiento->codigo . '-' . $reconocimiento->cliente->nombre . '.pdf';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reconocimiento')
            ->subject('Reconocimiento - Foro Emprendedor Tapachula')
            ->attachData($this->pdf->output(), $this->fileName);
    }
}
