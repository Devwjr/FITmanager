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
       Schema::create('treinos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('aluno_id');
        $table->string('tipo_treino');
        $table->integer('series')->nullable();
        $table->integer('repeticoes')->nullable();
        $table->timestamps();
        $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
});


    /**
     * Reverse the migrations.
     */
        Schema::dropIfExists('treinos');
    }
};
