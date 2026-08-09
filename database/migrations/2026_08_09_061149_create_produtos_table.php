<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
           $table->id();
        $table->string('nome');
        $table->text('descricao');

        //10 é o total de dígitos antes e depois da vírgula, 2 é o número de casas decimais
        $table->decimal('preco', 10, 2);

        $table->string('foto');

        //nullable() é q pode ser nulo
        $table->string('decada')->nullable();

        $table->integer('quantidade');
        $table->boolean('vendido')->default(false);
        $table->foreignId('categoria_id')->constrained('categorias');
        $table->foreignId('usuario_id')->constrained('users');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
