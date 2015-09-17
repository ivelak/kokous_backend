<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

    
    public function up() {
        Schema::create('events', function (Blueprint $table) {
            $table->string('eventName');
            $table->integer('eventId');
            $table->date('date');
            $table->dateTime('time');
            $table->integer('authorityId');
            $table->string('place');
            $table->string('activity');
            
        });
    }

    
    public function down() {
        Schema::drop('events');
    }

}
