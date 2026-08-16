<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailUsuario extends Mailable
{
    use Queueable, SerializesModels;

    public $conteudo;

    public function __construct($conteudo)
    {
        $this->conteudo = $conteudo;
    }

    public function build()
    {
        return $this->subject('Mensagem do Baú Digital')
            ->view('emails.usuario');
    }
}