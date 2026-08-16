<?php

namespace App\Http\Controllers;

use App\Mail\EmailUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function create()
    {
        if (auth()->user()->tipo !== 'admin') {
            abort(403);
        }

        $usuarios = User::where('tipo', '!=', 'admin')->get();

        return view('emails.create', compact('usuarios'));
    }

    public function send(Request $request)
    {
        if (auth()->user()->tipo !== 'admin') {
            abort(403);
        }

        $dados = $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'conteudo' => 'required|string',
        ]);

        $usuario = User::find($dados['usuario_id']);

        Mail::to($usuario->email)->send(new EmailUsuario($dados['conteudo']));

        return redirect()->route('email.create')->with('sucesso', 'E-mail enviado com sucesso!');
    }
}