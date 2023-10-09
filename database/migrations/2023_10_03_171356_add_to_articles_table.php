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
        Schema::table('articles', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id');//aggiungo la colonna per l'id
            $table->foreign('author_id')->references('id')->on('authors');//dico che author_id é una foreign key che fa riferimento alla chiave id nella tabella authors
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['author_id']); //elimino la relazione
            $table->dropColumn(['author_id']); //elimino la colonna
        });
    }
};
