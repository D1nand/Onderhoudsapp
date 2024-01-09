<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $passwordCode;

    public function __construct($passwordCode)
    {
        $this->passwordCode = $passwordCode;
    }

    public function build()
    {
        return $this->from('noreply@onderhoudsapp.nl','noreply')->subject('Voltooi uw registratie')->markdown('emails.set_password')
                    ->with([
                        'passwordCode' => $this->passwordCode,
                    ]);
    }
}
