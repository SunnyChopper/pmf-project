<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_analytics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number_of_logins');
            $table->integer('number_of_impressions');
            $table->integer('number_of_signups');
            $table->integer('number_of_ideas');
            $table->integer('number_of_idea_edits');
            $table->integer('number_of_landing_pages');
            $table->integer('number_of_landing_page_edits');
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
        Schema::dropIfExists('user_analytics');
    }
}
