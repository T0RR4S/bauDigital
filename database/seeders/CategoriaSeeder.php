<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
        'Câmeras & Fotografia',
        'Videogames & Consoles',
        'Áudio & Música',
        'Telefonia',
        'Informática antiga',
        'Vídeo & TV',];

       foreach ($categorias as $nome) {
            \App\Models\Categoria::firstOrCreate(['nome' => $nome]);
        }
    }
}
