<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventOccurrencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_occurrences', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->boolean ('cancelled')->default(false);
            $table->date('date');
            $table->time('time')->nullable();
            $table->string('place')->nullable();
            $table->text('notes')->nullable();
            $table->integer('event_id')->unsigned()->index();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_occurrences');
    }
}
