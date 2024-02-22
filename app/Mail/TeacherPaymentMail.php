<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Markdown;
use Illuminate\Queue\SerializesModels;

class TeacherPaymentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bill_details;

    /**
     * Create a new message instance.
     *
     * @param $bill_details
     */
    public function __construct($bill_details)
    {
        $this->bill_details = $bill_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Payment Confirmation - ' . $this->bill_details->order_number)
            ->markdown('mail.teacher_payment');
    }
}
