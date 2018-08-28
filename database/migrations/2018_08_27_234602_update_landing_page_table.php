<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLandingPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('landing_page', function($table) {
            // Add missing fields
            $table->string('idea_name', 512);
            $table->string('preview_link', 256);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('landing_page', function($table) {
            // Drop columns
            $table->dropColumn('idea_name');
            $table->dropColumn('preview_link');
        });
    }
}
