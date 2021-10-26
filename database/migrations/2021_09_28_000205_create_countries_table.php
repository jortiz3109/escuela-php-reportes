<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->binaryUuid('uuid')->unique();
            $table->char('numeric_code', 3)->unique();
            $table->char('alpha_3_code', 3)->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
}
