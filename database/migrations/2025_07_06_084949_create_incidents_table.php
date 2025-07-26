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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // L'utilisateur qui a signalé
            $table->string('type'); // 'médical' ou 'disciplinaire'
            $table->text('description');
            $table->timestamp('incident_date');
            $table->text('follow_up')->nullable(); // Suivi par l'infirmier/directeur
            $table->string('status')->default('ouvert'); // 'ouvert' ou 'fermé'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
