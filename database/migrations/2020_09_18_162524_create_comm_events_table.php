<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comm_events', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("comment_id");
            $table->string("label");
            $table->datetime("date");
            $table->string("text");
            $table->timestamps();

            $table->index("comment_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comm_events');
    }
}
