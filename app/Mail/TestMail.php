<?php

namespace App\Mail;

use App\Models\Chat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $chat;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('chat.index');
    }
}
