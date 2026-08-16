<x-app-layout>
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Editar Produto</h1>

        <form action="{{ route('produtos.update', $produto) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Nome</label>
                <input type="text" name="nome" value="{{ old('nome', $produto->nome) }}" class="border rounded w-full px-3 py-2">
                @error('nome') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Descrição</label>
                <textarea name="descricao" class="border rounded w-full px-3 py-2">{{ old('descricao', $produto->descricao) }}</textarea>
                @error('descricao') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Preço</label>
                <input type="number" step="0.01" name="preco" value="{{ old('preco', $produto->preco) }}" class="border rounded w-full px-3 py-2">
                @error('preco') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Foto atual</label>
                <img src="{{ asset('storage/' . $produto->foto) }}" class="w-32 h-32 object-cover rounded mb-2">

                <label class="block font-medium">Trocar foto (opcional)</label>
                <input type="file" name="foto" accept="image/*" class="border rounded w-full px-3 py-2">
                @error('foto') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Década</label>
                <input type="text" name="decada" value="{{ old('decada', $produto->decada) }}" class="border rounded w-full px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">Quantidade</label>
                <input type="number" name="quantidade" value="{{ old('quantidade', $produto->quantidade) }}" class="border rounded w-full px-3 py-2">
                @error('quantidade') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-medium">Categoria</label>
                <select name="categoria_id" class="border rounded w-full px-3 py-2">
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected($produto->categoria_id == $categoria->id)>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">
                Salvar Alterações
            </button>
        </form>
    </div>
</x-app-layout>