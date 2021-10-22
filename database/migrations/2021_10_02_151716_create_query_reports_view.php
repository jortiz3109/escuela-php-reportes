<?php

use Illuminate\Database\Migrations\Migration;

class CreateQueryReportsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(File::get('database/sql/CreateQueryReportsView.sql'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared(File::get('database/sql/DeleteQueryReportsView.sql'));
    }
}
