<?php

namespace App\Mail;

use App\Models\TicketBookingMode;
use Illuminate\Bus\Queueable;
use Illuminate\Console\View\Components\Confirm;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class TicketConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mailData;
    public $filePath;

    /**
     * Create a new message instance.
     */
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
        $uploadedTicket = TicketBookingMode::where('app_id', $mailData['app_id'])->first();
        $this->filePath = public_path(Storage::URL($uploadedTicket->ticket_filepath));
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reservation Assistance | Ticket Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.ticketConfirmationMail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->filePath)
                    ->as('Ticket.pdf')
        ];
    }
}
