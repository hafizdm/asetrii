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
        Schema::table('stock_logs', function (Blueprint $table) {
            $table->index('item_id');
            $table->foreign('item_id')
            ->references('id')->on('items');

            $table->index('user_id');       
            $table->foreign('user_id')
            ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_logs', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
            $table->dropIndex(['item_id']);

            $table->dropForeign(['user_id']);
            $table->dropIndex(['user_id']);
        });
    }
};
