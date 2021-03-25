<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('market_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('equipement_id')->nullable();
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->unsignedBigInteger('equipement_stock_id')->nullable();
            $table->unsignedBigInteger('piece_id')->nullable();
            $table->unsignedBigInteger('bon_id')->nullable();
            $table->datetime('date');
            $table->text('description');
            $table->timestamps();

            $table->index('user_id');
            $table->index('market_id');
            $table->index('client_id');
            $table->index('equipement_id');
            $table->index('ticket_id');
            $table->index('equipement_stock_id');
            $table->index('piece_id');
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
        Schema::dropIfExists('events');
    }
}
