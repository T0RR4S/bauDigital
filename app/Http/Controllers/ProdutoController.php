<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $query = Produto::where('vendido', false);

        if ($request->filled('busca')) {
            $query->where('nome', 'like', '%' . $request->busca . '%');
        }

        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        $produtos = $query->paginate(9);
        $categorias = Categoria::all();

        return view('produtos.index', compact('produtos', 'categorias'));
    }

    public function show(Produto $produto)
    {
        return view('produtos.show', compact('produto'));
    }

    public function meusProdutos()
    {
        $produtos = Produto::where('usuario_id', auth()->id())->paginate(9);

        return view('produtos.meus', compact('produtos'));
    }

    public function create()
    {
        if (auth()->user()->tipo === 'admin') {
            abort(403, 'Administradores não podem criar produtos.');
        }

        $categorias = Categoria::all();

        return view('produtos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->tipo === 'admin') {
            abort(403, 'Administradores não podem criar produtos.');
        }

        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric|min:0',
            'foto' => 'required|image|max:4096',
            'decada' => 'nullable|string',
            'quantidade' => 'required|integer|min:1',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        if ($request->hasFile('foto')) {
            $caminho = $request->file('foto')->store('produtos', 'public');
            $dados['foto'] = $caminho;
        }

        $dados['usuario_id'] = auth()->id();
        $dados['vendido'] = false;

        Produto::create($dados);

        return redirect()->route('produtos.meus')->with('sucesso', 'Produto criado com sucesso!');
    }

    public function edit(Produto $produto)
    {
        if ($produto->usuario_id !== auth()->id() && auth()->user()->tipo !== 'admin') {
            abort(403);
        }

        $categorias = Categoria::all();

        return view('produtos.edit', compact('produto', 'categorias'));
    }

    public function update(Request $request, Produto $produto)
    {
        if ($produto->usuario_id !== auth()->id() && auth()->user()->tipo !== 'admin') {
            abort(403);
        }

        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric|min:0',
            'foto' => 'nullable|image|max:4096',
            'decada' => 'nullable|string',
            'quantidade' => 'required|integer|min:1',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        if ($request->hasFile('foto')) {
            $caminho = $request->file('foto')->store('produtos', 'public');
            $dados['foto'] = $caminho;
        } else {
            unset($dados['foto']);
        }

        $produto->update($dados);

        return redirect()->route('produtos.meus')->with('sucesso', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        if ($produto->usuario_id !== auth()->id() && auth()->user()->tipo !== 'admin') {
            abort(403);
        }

        $produto->delete();

        return redirect()->route('produtos.meus')->with('sucesso', 'Produto excluído com sucesso!');
    }

    public function todosProdutos()
    {
        if (auth()->user()->tipo !== 'admin') {
            abort(403);
        }

        $produtos = Produto::with('usuario')->paginate(9);

        return view('produtos.todos', compact('produtos'));
    }
}