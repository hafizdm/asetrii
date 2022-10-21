<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->index('stock_id'); // perintah untuk memberikan index ke stock id
            $table->foreign('stock_id') // yang menjadi kunci tamu stock_id
            ->references('id')->on('stocks'); //-> perintah untuk terhubung ke tabel stock

            $table->index('kind_id');
            $table->foreign('kind_id')
            ->references('id')->on('categories');

            $table->index('merk_id');
            $table->foreign('merk_id')
            ->references('id')->on('categories');

            $table->index('unit_id');
            $table->foreign('unit_id')
            ->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['stock_id']);
            $table->dropIndex(['stock_id']);

            $table->dropForeign(['kind_id']);
            $table->dropIndex(['kind_id']);

            $table->dropForeign(['merk_id']);
            $table->dropIndex(['merk_id']);

            $table->dropForeign(['unit_id']);
            $table->dropIndex(['unit_id']);
        });
    }
};
