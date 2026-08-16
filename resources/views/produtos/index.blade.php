<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        @if (session('sucesso'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('sucesso') }}
            </div>
        @endif

        {{-- Barra de busca e filtro --}}
                <form method="GET" action="{{ route('home') }}" class="flex flex-col sm:flex-row gap-4 mb-6">            <input
                type="text"
                name="busca"
                placeholder="Buscar produto..."
                value="{{ request('busca') }}"
                class="border rounded px-4 py-2 flex-1"
            >

            <select name="categoria_id" class="border rounded px-4 py-2">
                <option value="">Todas as categorias</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" @selected(request('categoria_id') == $categoria->id)>
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded">
                Filtrar
            </button>
        </form>

        {{-- Lista de produtos --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse ($produtos as $produto)
                <div class="border rounded-lg p-4 shadow-sm">
                    <img src="{{ asset('storage/' . $produto->foto) }}" alt="{{ $produto->nome }}" class="w-full h-40 object-cover rounded mb-3">

                   <a href="{{ route('produto.show', $produto->id) }}">
                    <h3 class="font-bold text-lg hover:underline">{{ $produto->nome }}</h3>
                    </a>
                    <p class="text-gray-600">{{ formatar_preco($produto->preco) }}</p>

                    @auth
                        @if (auth()->user()->id !== $produto->usuario_id && !$produto->vendido)
                            <form action="{{ route('produto.comprar', $produto) }}" method="POST">
                                @csrf
                                <button type="submit" class="mt-3 bg-green-600 text-white px-4 py-2 rounded w-full">
                                    Comprar
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">Nenhum produto encontrado.</p>
            @endforelse
        </div>

        {{-- Paginação --}}
        <div class="mt-6">
            {{ $produtos->links() }}
        </div>

    </div>
</x-app-layout>