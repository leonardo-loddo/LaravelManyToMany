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
        Schema::create('article_category', function (Blueprint $table) {
            $table->id();

            //creo le colonne con chiavi esterne
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('category_id');
            //creo le relazioni
            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article_category', function (Blueprint $table) {
            //elimino le relazioni
            $table->dropForeign(['article_id', 'category_id']);
            //elimino le colonne
            $table->dropColumn(['article_id', 'category_id']);
        });
    }
};
