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
        Schema::create('stock_logs', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("item_id");
            $table->uuid("user_id");
            $table->string("type"); // between: in or out
            $table->decimal("amount", 15, 2);
            $table->string("reciever")->nullable();
            $table->string("role")->nullable();
            $table->string("notes")->nullable();
            $table->dateTime("moved_at");
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
        Schema::dropIfExists('stock_logs');
    }
};
