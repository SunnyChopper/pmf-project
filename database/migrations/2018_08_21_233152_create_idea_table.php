<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdeaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idea', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name', 512);
            $table->text('description');
            $table->integer('landing_pages');
            $table->integer('impressions');
            $table->integer('signups');
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
        Schema::dropIfExists('idea');
    }
}
