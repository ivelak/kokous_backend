<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventPatternsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('event_patterns', function (Blueprint $table) {
            $table->string('name');
            $table->increments('id');
            $table->timestamps();
            $table->date('date');
            $table->date('endDate');
            $table->time('time')->nullable();
            $table->string('place')->nullable();
            $table->text('notes')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('event_patterns');
    }

}
