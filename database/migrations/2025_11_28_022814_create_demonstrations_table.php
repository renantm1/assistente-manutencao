<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demonstrations', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('cliente');
            $table->string('maquina');
            $table->dateTime('data_hora');
            $table->enum('status', ['agendada', 'realizada', 'cancelada'])->default('agendada');
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demonstrations');
    }
};
