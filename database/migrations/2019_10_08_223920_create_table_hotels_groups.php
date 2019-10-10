<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHotelsGroups extends Migration
{
    /**
     * Run the migrations.
     * Groups of hotels
     * @return void
     */
    public function up()
    {
        Schema::create('hotels_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->string('name', 120)->index();
            $table->string('description')->nullable();
            $table->string('logo')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotels_groups');
    }
}
