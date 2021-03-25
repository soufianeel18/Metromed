<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->UnsignedBigInteger('equipement_stock_id')->nullable();
            $table->UnsignedBigInteger('piece_id')->nullable();
            $table->string('cname');
            $table->string('cphone');
            $table->string('n_market')->nullable();
            $table->string('ville')->nullable();
            $table->dateTime('date');
            $table->UnsignedBigInteger('quantite');
            $table->string('type');
            $table->timestamps();

            $table->index('equipement_stock_id');
            $table->index('piece_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bons');
    }
}
