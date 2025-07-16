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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_id')->constrained()->onDelete('cascade');
            $table->date('absence_date');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Le moniteur qui a signalé l'absence
            $table->text('reason')->nullable(); // Raison de l'absence si connue
            $table->timestamps();

            // Assurer qu'un enfant ne peut être absent qu'une fois par jour
            $table->unique(['child_id', 'absence_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
