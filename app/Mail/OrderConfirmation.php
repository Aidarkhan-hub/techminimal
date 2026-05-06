<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public array $cartItems;
    public float $total;
    public string $customerName;

    public function __construct(array $cartItems, float $total, string $customerName)
    {
        $this->cartItems = $cartItems;
        $this->total = $total;
        $this->customerName = $customerName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Ваш заказ подтверждён — TechMinimal');
    }

    public function content(): Content
    {
        return new Content(view: 'mails.order_confirmation');
    }
}
