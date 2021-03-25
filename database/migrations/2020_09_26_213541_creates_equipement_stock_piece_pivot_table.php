<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesEquipementStockPiecePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipement_stock_piece', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('equipement_stock_id');
            $table->unsignedBigInteger('piece_id');
            $table->unsignedBigInteger('quantite_eq')->nullable();
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
        Schema::dropIfExists('equipement_stock_piece');
    }
}
