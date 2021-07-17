<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TicketsConnection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_connection', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parentticket_id');
            $table->unsignedBigInteger('childticket_id');
            $table->unsignedBigInteger('ticketrelation_id');
            $table->timestamps();

            $table->index('id');
            $table->index('parentticket_id');
            $table->index('childticket_id');
            $table->index('ticketrelation_id');

            $table->foreign('parentticket_id')->references('id')->on('ticket');
            $table->foreign('childticket_id')->references('id')->on('ticket');
            $table->foreign('ticketrelation_id')->references('id')->on('ticket_relation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_relation');
    }
}
