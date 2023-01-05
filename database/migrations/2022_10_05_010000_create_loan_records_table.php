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
        Schema::create('loan_records', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('item_id');
            $table->boolean('is_in')->default(true); // true: in, false: out
            $table->string('notes')->nullable();
            $table->string('receipt')->nullable();
            $table->string('position')->nullable();
            $table->string('upload_file')->nullable();
            $table->datetime('created');
            $table->timestamps();
            $table->softDeletes();
            // php artisan migrate:fresh --seed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('land_notes');
    }
};
