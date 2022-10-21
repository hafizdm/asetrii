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
        //untuk menjalanin perintah migration data
        Schema::table('categories', function (Blueprint $table) {
            $table->index('category_id');
            $table->foreign('category_id')
            ->references('id')->on('categories');

            $table->unique(['name', 'group_by']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique(['name', 'group_by']);

            $table->dropForeign(['category_id']);
            $table->dropIndex(['category_id']);
        });
    }
};
