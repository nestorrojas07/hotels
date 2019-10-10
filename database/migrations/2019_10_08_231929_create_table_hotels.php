<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHotels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();

            $table->unsignedInteger('group_hotel_id')->nullable();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('city');
            $table->unsignedInteger('starts');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('group_hotel_id' )
                ->references('id')
                ->on('hotels_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotels');
    }
}
