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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('id_jabatan')->constrained('jabatans')->restrict('onDelete')->cascade('onUpdate');
            $table->text('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('sk')->nullable();
            $table->string('aktif')->nullable();
            $table->string('hp')->nullable();
            $table->string('email')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->boolean('isKetua');
            $table->foreignId('id_user')->constrained('users')->restrict('onDelete')->cascade('onUpdate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
