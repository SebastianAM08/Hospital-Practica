<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->string('codigo_ingreso', 20)->primary();
            $table->string('habitacion', 20);
            $table->date('fecha');
            $table->string('codigo_medico', 20);
            $table->string('codigo_paciente', 20);
            $table->timestamps();

            $table->foreign('codigo_medico')
                ->references('codigo_medico')
                ->on('medicos')
                ->onDelete('restrict');

            $table->foreign('codigo_paciente')
                ->references('codigo_paciente')
                ->on('pacientes')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};
