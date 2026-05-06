<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewOrderSeller extends Mailable
{
    use Queueable, SerializesModels;

    public array $items;
    public string $customerName;
    public float $total;

    public function __construct(array $items, string $customerName, float $total)
    {
        $this->items = $items;
        $this->customerName = $customerName;
        $this->total = $total;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: '🛒 Новый заказ на TechMinimal');
    }

    public function content(): Content
    {
        return new Content(view: 'mails.new_order_seller');
    }
}
