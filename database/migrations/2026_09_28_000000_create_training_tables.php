<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $t) {
            $t->string('username')->nullable()->unique();
        });
        Schema::create('exercises', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('muscle_group');
            $t->text('instructions')->nullable();
            $t->timestamps();
        });
        Schema::create('workouts', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained()->cascadeOnDelete();
            $t->string('name');
            $t->unsignedInteger('days_per_week');
            $t->text('notes')->nullable();
            $t->json('items');
            $t->timestamps();
        });
        Schema::create('training_sessions', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained()->cascadeOnDelete();
            $t->date('performed_on');
            $t->text('notes')->nullable();
            $t->json('items');
            $t->timestamps();
            $t->index(['user_id', 'performed_on']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_sessions');
        Schema::dropIfExists('workouts');
        Schema::dropIfExists('exercises');
        Schema::table('users', function (Blueprint $t) {
            $t->dropColumn('username');
        });
    }
};
