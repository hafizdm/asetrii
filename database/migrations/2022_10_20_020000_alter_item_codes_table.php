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
        Schema::table('item_codes', function (Blueprint $table) {
            $table->index('item_id');
            $table->foreign('item_id')
            ->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_codes', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
            $table->dropIndex(['item_id']);
        });
    }
};
