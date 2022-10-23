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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("stock_id");
            $table->uuid("kind_id");
            $table->uuid("merk_id");
            $table->uuid("unit_id");
            $table->string("type"); // asset, non-asset
            $table->string("name");
            $table->integer("year")->nullable();
            $table->string("notes")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
