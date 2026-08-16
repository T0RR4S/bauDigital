<x-app-layout>
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Histórico de Vendas</h1>

        <a href="{{ route('vendas.pdf') }}" class="bg-red-600 text-white px-4 py-2 rounded inline-block mb-4">
            Gerar PDF
        </a>

        @if (session('sucesso'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('sucesso') }}
            </div>
        @endif

        <table class="w-full border-collapse">
            <thead>
                <tr class="border-b text-left">
                    <th class="py-2">Produto</th>
                    <th class="py-2">Data</th>
                    <th class="py-2">Valor</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($itensVendidos as $item)
                    <tr class="border-b">
                        <td class="py-2 flex items-center gap-2">
                            <img src="{{ asset('storage/' . $item->produto->foto) }}" class="w-12 h-12 object-cover rounded">
                            {{ $item->produto->nome }}
                        </td>
                        <td class="py-2">{{ $item->created_at->format('d/m/Y') }}</td>
                        <td class="py-2">{{ formatar_preco($item->preco_unitario) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-gray-500 py-4">Nenhuma venda realizada ainda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-6">
            {{ $itensVendidos->links() }}
        </div>
    </div>
</x-app-layout>