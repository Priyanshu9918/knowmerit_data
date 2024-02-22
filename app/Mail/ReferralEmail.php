<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReferralEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $referralCode;


    public function __construct($referralCode)
    {
        $this->referralCode = $referralCode;
    }


    public function envelope()
    {
        return new Envelope(
            subject: 'Refer a Friend to KnowMerit - Earn Rewards!',
        );
    }


    // public function content()
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }


    public function build() {
        return $this->view('mail.referral_email')
            // ->with([
            //     'referralCode' => $this->referralCode,
            // ])
            // ->subject('Join Us with a Referral Code!');
            ->with('referralCode', $this->referralCode);
    }

    public function attachments()
    {
        return [];
    }
}
