<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nom de la chambre
            $table->integer('number'); // numéro de la chambre
            $table->string('description')->nullable(); // description de la chambre
            $table->boolean('is_available')->default(true); // disponibilité de la chambre
            $table->foreignId('floor_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
