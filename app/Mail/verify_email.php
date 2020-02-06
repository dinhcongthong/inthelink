<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;


class Verify_email extends Mailable
{

    use Queueable, SerializesModels;

    /**
     * The user instance.
     *
     * @var Order
     */
    private $mail;
    private $code;
    /**

     * Create a new message instance.

     *

     * @return void

     */
    public function __construct($code)
    {
        $this->code = $code;
        $this->mail = env('MAIL_USERNAME');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $title = 'Verify your email address';
        $confirmation_code = $this->code;
        return $this->view('email.verify',compact('confirmation_code'))
                ->from($this->mail,'IN THE LINK')
                ->subject($title);

    }

}
