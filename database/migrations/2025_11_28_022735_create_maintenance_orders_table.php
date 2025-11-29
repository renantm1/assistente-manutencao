<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_orders', function (Blueprint $table) {
            $table->id();
            $table->string('numero_om')->unique();
            $table->string('maquina');
            $table->text('descricao');
            $table->enum('status', ['pendente', 'em_andamento', 'concluida'])->default('pendente');
            $table->date('data_vencimento');
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_orders');
    }
};
