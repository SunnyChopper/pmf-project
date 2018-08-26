<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_page', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idea_id');
            $table->string('name', 512);
            $table->string('landing_page_template_path', 512);
            $table->string('xml_link', 512);
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
        Schema::dropIfExists('landing_page');
    }
}
