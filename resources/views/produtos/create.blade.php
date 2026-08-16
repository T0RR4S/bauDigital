<x-app-layout>
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Novo Produto</h1>

        <form action="{{ route('produtos.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf

            <div>
                <label class="block font-medium">Nome</label>
                <input type="text" name="nome" value="{{ old('nome') }}" class="border rounded w-full px-3 py-2">
                @error('nome') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Descrição</label>
                <textarea name="descricao" class="border rounded w-full px-3 py-2">{{ old('descricao') }}</textarea>
                @error('descricao') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Preço</label>
                <input type="number" step="0.01" name="preco" value="{{ old('preco') }}" class="border rounded w-full px-3 py-2">
                @error('preco') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Foto</label>
                <input type="file" name="foto" accept="image/*" class="border rounded w-full px-3 py-2">
                @error('foto') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Década</label>
                <input type="text" name="decada" value="{{ old('decada') }}" class="border rounded w-full px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">Quantidade</label>
                <input type="number" name="quantidade" value="{{ old('quantidade') }}" class="border rounded w-full px-3 py-2">
                @error('quantidade') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Categoria</label>
                <select name="categoria_id" class="border rounded w-full px-3 py-2">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                    @endforeach
                </select>
                @error('categoria_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">
                Criar Produto
            </button>
        </form>
    </div>
</x-app-layout>