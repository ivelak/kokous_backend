<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityEventOccurrencePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_event_occurrence', function(Blueprint $table) {
            $table->integer('activity_id')->unsigned()->index();
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
            $table->integer('event_occurrence_id')->unsigned()->index();
            $table->foreign('event_occurrence_id')->references('id')->on('event_occurrences')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activity_event_occurrence');
    }
}
