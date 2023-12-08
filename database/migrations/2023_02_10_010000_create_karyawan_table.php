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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("nik")->unique()->nullable();
            $table->string("nama_karyawan");
            $table->string("alamat");
            $table->string("email");
            $table->string("no_hp");
            $table->string("agama");
            $table->string("jabatan");
            $table->string("division");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
};
