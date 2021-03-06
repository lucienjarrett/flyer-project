<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flyers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true)->length(10); 
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); 
            $table->string('street');
            $table->string('city');
            $table->string('zip', 10);
            $table->string('country');
            $table->string('state', 40);
            $table->integer('price'); 
            $table->text('description');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::drop('flyers');

    }
}
