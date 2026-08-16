<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">

        <a href="{{ route('home') }}" class="text-blue-600 underline">&larr; Voltar</a>

        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-8">

            <img src="{{ asset('storage/' . $produto->foto) }}" alt="{{ $produto->nome }}" class="w-full rounded-lg shadow">

            <div>
                <h1 class="text-2xl font-bold">{{ $produto->nome }}</h1>
                <p class="text-gray-500 mt-1">{{ $produto->categoria->nome }}</p>

                <p class="text-3xl font-bold mt-4">{{ formatar_preco($produto->preco) }}</p>

                <p class="mt-4 text-gray-700">{{ $produto->descricao }}</p>

                <ul class="mt-4 text-sm text-gray-600 space-y-1">
                    <li><strong>Quantidade disponível:</strong> {{ $produto->quantidade }}</li>
                    @if ($produto->decada)
                        <li><strong>Década:</strong> {{ $produto->decada }}</li>
                    @endif
                </ul>

                <div class="mt-6 border-t pt-4">
                    <p class="font-semibold">Anunciado por:</p>
                    <p>{{ $produto->usuario->name }}</p>
                    @if ($produto->usuario->telefone ?? false)
                        <p>{{ $produto->usuario->telefone }}</p>
                    @endif
                </div>

                @auth
                    @if (auth()->user()->id !== $produto->usuario_id)
                        <form action="{{ route('produto.comprar', $produto) }}" method="POST">
                            @csrf
                            <button type="submit" class="mt-6 bg-green-600 text-white px-6 py-3 rounded w-full">
                                Comprar
                            </button>
                        </form>
                    @endif
                @endauth
            </div>

        </div>
    </div>
</x-app-layout>