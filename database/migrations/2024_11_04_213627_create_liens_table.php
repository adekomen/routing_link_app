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
        Schema::create('liens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('routeur1_id')->constrained('routeurs')->onDelete('cascade');
            $table->foreignId('routeur2_id')->constrained('routeurs')->onDelete('cascade');
            $table->integer('cout')->default(1);
            $table->string('reseau')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liens');
    }
};
