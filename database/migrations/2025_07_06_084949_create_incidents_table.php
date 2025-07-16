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
            $table->enum('type', ['médical', 'disciplinaire']);
            $table->text('description');
            $table->timestamp('incident_date');
            $table->text('follow_up')->nullable(); // Suivi par l'infirmier/directeur
            $table->enum('status', ['ouvert', 'fermé'])->default('ouvert');
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
