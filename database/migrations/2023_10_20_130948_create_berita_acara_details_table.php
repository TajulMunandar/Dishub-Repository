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
        Schema::create('berita_acara_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_berita')->constrained('berita_acaras')->restrict('onDelete')->cascade('onUpdate');
            $table->time('waktu');
            $table->text('uraian');
            $table->text('ket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_acara_details');
    }
};
