<x-app-layout>
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Enviar E-mail</h1>

        @if (session('sucesso'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('sucesso') }}
            </div>
        @endif

        <form action="{{ route('email.send') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Usuário</label>
                <select name="usuario_id" class="border rounded w-full px-3 py-2">
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->name }} ({{ $usuario->email }})</option>
                    @endforeach
                </select>
                @error('usuario_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Mensagem</label>
                <textarea name="conteudo" rows="6" class="border rounded w-full px-3 py-2">{{ old('conteudo') }}</textarea>
                @error('conteudo') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">
                Enviar E-mail
            </button>
        </form>
    </div>
</x-app-layout>