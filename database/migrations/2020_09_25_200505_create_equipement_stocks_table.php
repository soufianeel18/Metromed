<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipementStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipement_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('designation');
            $table->string('marque');
            $table->string('model');
            $table->string('n_inv')->nullable();
            $table->unsignedBigInteger('quantite');
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
        Schema::dropIfExists('equipement_stocks');
    }
}
