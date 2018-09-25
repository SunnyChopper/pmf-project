<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingPageRefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_page_ref', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('landing_page_id');
            $table->string('ref_source', 256);
            $table->integer('reach');
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
        Schema::dropIfExists('landing_page_ref');
    }
}
