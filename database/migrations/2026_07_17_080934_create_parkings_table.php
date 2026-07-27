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
      Schema::create('parkings', function (Blueprint $table) {
    $table->id();

    $table->foreignId('vehicle_id')
          ->constrained('vehicles')
          ->onDelete('cascade');

    $table->dateTime('waktu_masuk');
    $table->dateTime('waktu_keluar')->nullable();

    $table->integer('durasi')->nullable();

    $table->decimal('tarif', 10, 2)->default(0);

    $table->enum('status', ['Masuk', 'Keluar'])
          ->default('Masuk');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkings');
    }
};
