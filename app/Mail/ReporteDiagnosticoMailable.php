<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteDiagnosticoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $registro;

    public function __construct($registro)
    {
        $this->registro = $registro;
    }

    public function build()
    {
        // Generar el PDF desde la vista Blade
        $pdf = Pdf::loadView('emails.reporte_diagnostico', ['registro' => $this->registro]);

        return $this->subject('Reporte de Diagnóstico')
            ->attachData($pdf->output(), 'reporte_diagnostico.pdf', [
                'mime' => 'application/pdf',
            ])
            ->view('mail.reporte_diagnostico', ['registro' => $this->registro]); // si deseas incluirlo en el cuerpo
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reporte Diagnostico Mailable',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
