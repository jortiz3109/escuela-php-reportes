<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->uuid('uuid')->unique();
            $table->char('alphabetic_code', 3)->unique();
            $table->char('numeric_code', 3)->unique();
            $table->char('minor_unit', 1)->default('0');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
}
