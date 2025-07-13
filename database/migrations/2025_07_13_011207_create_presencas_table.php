<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('presencas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('aluno_id');
        $table->date('data');
        $table->time('hora_entrada')->nullable();
        $table->time('hora_saida')->nullable();
        $table->timestamps();

        $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presencas');
    }
};
