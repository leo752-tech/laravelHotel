<?php

namespace App\Mail;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmed extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $booking;
    public $user;
    protected $invoiceId;
    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking, User $user, $invoiceId = null)
    {
        $this->booking = $booking;
        $this->user = $user;
        $this->invoiceId = $invoiceId;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Conferma Prenotazione - Hotel ' . config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.booking_confirmed',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        // Se abbiamo un ID fattura, generiamo l'allegato "al volo"
        if ($this->invoiceId) {
            $attachments[] = Attachment::fromData(
                fn() => $this->user->downloadInvoice($this->invoiceId)->getContent(),
                'fattura_prenotazione.pdf'
            )->withMime('application/pdf');
        }

        return $attachments;
    }
}
