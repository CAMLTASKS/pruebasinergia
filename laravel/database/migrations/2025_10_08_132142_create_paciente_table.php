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
        Schema::create('paciente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_documento_id')->constrained('tipos_documento')->onDelete('restrict');
            $table->string('numero_documento', 20);
            $table->string('nombre1', 100);
            $table->string('nombre2', 100)->nullable();
            $table->string('apellido1', 100);
            $table->string('apellido2', 100)->nullable();
            $table->foreignId('genero_id')->constrained('genero')->onDelete('restrict');
            $table->foreignId('departamento_id')->constrained('departamentos')->onDelete('restrict');
            $table->foreignId('municipio_id')->constrained('municipios')->onDelete('restrict');
            $table->string('correo', 150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paciente');
    }
};
