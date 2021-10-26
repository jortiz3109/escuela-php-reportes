<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CreateQueryReportsView extends Migration
{
    public function up()
    {
        DB::unprepared(File::get('database/sql/CreateQueryReportsView.sql'));
    }

    public function down()
    {
        DB::unprepared(File::get('database/sql/DeleteQueryReportsView.sql'));
    }
}
