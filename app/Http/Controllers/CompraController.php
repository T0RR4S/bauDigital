<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\ItemCompra;
use App\Models\Produto;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

class CompraController extends Controller
{
    public function comprar(Produto $produto)
    {
        if ($produto->usuario_id === auth()->id()) {
            abort(403, 'Você não pode comprar seu próprio produto.');
        }

        if ($produto->quantidade <= 0 || $produto->vendido) {
            return redirect()->back()->with('erro', 'Produto esgotado ou já vendido.');
        }

        $compra = Compra::create([
            'comprador_id' => auth()->id(),
            'valor_total' => $produto->preco,
            'status' => 'concluida',
            'data' => now(),
        ]);

        ItemCompra::create([
            'compra_id' => $compra->id,
            'produto_id' => $produto->id,
            'preco_unitario' => $produto->preco,
        ]);

        $produto->decrement('quantidade');
        if ($produto->quantidade <= 0) {
            $produto->update(['vendido' => true]);
        }

        $vendedor = $produto->usuario;
        $vendedor->increment('saldo', $produto->preco);

        return redirect()->route('home')->with('sucesso', 'Compra realizada com sucesso!');
    }

    public function historicoCompras()
    {
        $compras = Compra::where('comprador_id', auth()->id())
            ->with('itens.produto')
            ->orderBy('data', 'desc')
            ->paginate(10);

        return view('compras.historico', compact('compras'));
    }

    public function historicoVendas()
    {
        $itensVendidos = ItemCompra::whereHas('produto', function ($q) {
            $q->where('usuario_id', auth()->id());
        })->with('produto', 'compra')->orderByDesc('created_at')->paginate(10);

        return view('compras.vendas', compact('itensVendidos'));
    }

    public function pdfVendas()
    {
        $itensVendidos = ItemCompra::whereHas('produto', function ($q) {
            $q->where('usuario_id', auth()->id());
        })->with('produto', 'compra')->orderByDesc('created_at')->get();

        $pdf = Pdf::loadView('compras.pdf-vendas', compact('itensVendidos'));

        return $pdf->download('historico-vendas.pdf');
    }
}