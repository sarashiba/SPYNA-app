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
    Schema::table('answers', function (Blueprint $table) {
        $table->unsignedBigInteger('spirit_id')->after('question_id');

        // Kalau ada relasi:
        $table->foreign('spirit_id')->references('id')->on('spirits')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('answers', function (Blueprint $table) {
        $table->dropForeign(['spirit_id']);
        $table->dropColumn('spirit_id');
    });
}

};
