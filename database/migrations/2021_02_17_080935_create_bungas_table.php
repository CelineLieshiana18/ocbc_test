<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBungasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bungas', function (Blueprint $table) {
            $table->increments('id',)->primary();
            $table->char('no_rekening',12);
            $table->dateTime('tanggal_perubahan_bunga');
            $table->decimal('persen_bunga',5,2);
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
        Schema::dropIfExists('bungas');
    }
}
