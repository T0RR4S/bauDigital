<x-app-layout>
    <div class="max-w-6xl mx-auto p-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Meus Produtos</h1>
            <a href="{{ route('produtos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                + Novo Produto
            </a>
        </div>

        @if (session('sucesso'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('sucesso') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($produtos as $produto)
                <div class="border rounded-lg p-4 shadow-sm">
                    <img src="{{ asset('storage/' . $produto->foto) }}" alt="{{ $produto->nome }}" class="w-full h-40 object-cover rounded mb-3">
                    <a href="{{ route('produto.show', $produto) }}">
                     <h3 class="font-bold hover:underline">{{ $produto->nome }}</h3>
                    </a>
                    <p class="text-gray-600">{{ formatar_preco($produto->preco) }}</p>

                    <div class="flex gap-2 mt-3">
                        <a href="{{ route('produtos.edit', $produto) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                            Editar
                        </a>
                        <form action="{{ route('produtos.destroy', $produto) }}" method="POST" onsubmit="return confirm('Tem certeza?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm">
                                Excluir
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">Você ainda não anunciou nenhum produto.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $produtos->links() }}
        </div>
    </div>
</x-app-layout>