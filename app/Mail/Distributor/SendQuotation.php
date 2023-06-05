<?php

namespace App\Mail\Distributor;

use App\Http\Controllers\Distributor\Quotation\ExportForQuotationController;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class SendQuotation extends Mailable
{
    use Queueable, SerializesModels;

    public int $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Portal B2B - Nova cotação - Encoparts Global',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.quotation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return Attachment::fromPath(Excel::download(new ExportForQuotationController($this->id),  'quotation.xlsx')->getFile())
        ->as('cotacao-'.$this->id);
    }
}
