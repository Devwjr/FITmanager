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
       Schema::create('dietas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('aluno_id');
        $table->string('tipo_dieta'); // exemplo: low carb, hipercalórica...
        $table->integer('calorias')->nullable();
        $table->text('refeicoes')->nullable(); // descrição das refeições
        $table->timestamps();
        $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('cascade');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dietas');
    }
};
