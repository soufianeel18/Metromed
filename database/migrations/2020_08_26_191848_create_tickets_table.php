<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('equipement_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('status');
            $table->string('title');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('type')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('equipement_id');
            $table->index('client_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
