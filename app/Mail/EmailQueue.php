<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailQueue extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('jesusgilberdugo@gmail.com', 'Jesus')
            ->subject($this->title)
            ->view('emails.email')
            ->with(([
                'title' => $this->title
            ]));
    }
}
