<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

    public function up() {
        Schema::create('events', function (Blueprint $table) {
            $table->string('name');
            $table->increments('id');
            $table->dateTime('time'); // Sisältää ajan sekä paikan
            $table->date('endDate');
            $table->string('place');
            $table->text('description');
            $table->timestamps();
            $table->integer('group_id')->unsigned()->index();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::drop('events');
    }

}
