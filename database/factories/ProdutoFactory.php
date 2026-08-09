<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $produtos = [
        ['nome' => 'Canon AE-1', 'decada' => '1970s', 'preco' => 480, 'categoria' => 'Câmeras & Fotografia'],
        ['nome' => 'Polaroid SX-70', 'decada' => '1970s', 'preco' => 650, 'categoria' => 'Câmeras & Fotografia'],
        ['nome' => 'Nikon FM2', 'decada' => '1980s', 'preco' => 550, 'categoria' => 'Câmeras & Fotografia'],
        ['nome' => 'Atari 2600', 'decada' => '1980s', 'preco' => 550, 'categoria' => 'Videogames & Consoles'],
        ['nome' => 'Super Nintendo', 'decada' => '1990s', 'preco' => 600, 'categoria' => 'Videogames & Consoles'],
        ['nome' => 'PlayStation 1', 'decada' => '1990s', 'preco' => 450, 'categoria' => 'Videogames & Consoles'],
        ['nome' => 'Vitrola Garrard', 'decada' => '1960s', 'preco' => 900, 'categoria' => 'Áudio & Música'],
        ['nome' => 'Sony Walkman WM-10', 'decada' => '1980s', 'preco' => 250, 'categoria' => 'Áudio & Música'],
        ['nome' => 'Toca-discos Technics SL-1200', 'decada' => '1980s', 'preco' => 1500, 'categoria' => 'Áudio & Música'],
        ['nome' => 'Nokia 3310', 'decada' => '2000s', 'preco' => 220, 'categoria' => 'Telefonia'],
        ['nome' => 'Motorola StarTac', 'decada' => '1990s', 'preco' => 380, 'categoria' => 'Telefonia'],
        ['nome' => 'Macintosh Classic', 'decada' => '1980s', 'preco' => 1200, 'categoria' => 'Informática antiga'],
        ['nome' => 'Calculadora HP-12C original', 'decada' => '1980s', 'preco' => 300, 'categoria' => 'Informática antiga'],
        ['nome' => 'TV de tubo Sharp 14"', 'decada' => '1990s', 'preco' => 250, 'categoria' => 'Vídeo & TV'],
        ['nome' => 'Videocassete Sony Betamax', 'decada' => '1980s', 'preco' => 400, 'categoria' => 'Vídeo & TV'],
    ];

    $escolhido = fake()->randomElement($produtos);

    return [
        'nome' => $escolhido['nome'],
        'descricao' => fake()->sentence(12),
        'preco' => $escolhido['preco'],
        'foto' => fake()->imageUrl(640, 480, 'tech'),
        'decada' => $escolhido['decada'],
        'quantidade' => fake()->numberBetween(1, 5),
        'vendido' => false,
        'categoria_id' => \App\Models\Categoria::where('nome', $escolhido['categoria'])->first()->id,
        'usuario_id' => \App\Models\User::inRandomOrder()->first()->id,
    ];
}
}
