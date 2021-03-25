<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonPiecesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bon_pieces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bon_id');
            $table->unsignedBigInteger('unique_id');
            $table->string('designation');
            $table->string('marque');
            $table->string('model');
            $table->string('n_inv')->nullable();
            $table->unsignedBigInteger('quantite_eq');
            $table->timestamps();

            $table->index('bon_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bon_pieces');
    }
}
