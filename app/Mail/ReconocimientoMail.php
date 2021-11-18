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
    protected $reconocimiento;
    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->reconocimiento = Reconocimiento::find($id);
        $this->fileName = $this->reconocimiento->codigo . '-' . $this->reconocimiento->cliente->nombre . '.pdf';
        $this->url = "public/pdf/$this->fileName";

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $location = storage_path($this->url);
        return $this->markdown('emails.reconocimiento')
            ->subject('Reconocimiento - Foro Emprendedor Tapachula')
            ->attach(storage_path("app/public/pdf/$this->fileName"), [
                'as' => $this->fileName,
                'mime' => 'application/pdf'
            ]);
    }
}
