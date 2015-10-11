<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

    
    public function up() {
        Schema::create('events', function (Blueprint $table) {
            $table->string('name');
            $table->increments('id');
            $table->dateTime('time'); // Sisältää ajan sekä paikan
            $table->date('endDate')->nullable();
            $table->string('place');
            $table->text('description');
            $table->timestamps();
            
        });
    }

    
    public function down() {
        Schema::drop('events');
    }

}
