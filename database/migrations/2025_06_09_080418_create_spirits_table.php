<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('spirits', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('spirit');
            $table->string('julukan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('gambar_animal')->nullable();
            $table->string('gambar_logo')->nullable();
            $table->string('gambar_elemen')->nullable();
            $table->string('warna');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spirits');
    }
};
