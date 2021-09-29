<?php

use App\Constants\ExportModels;
use App\Constants\Exports;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->nullable();
            $table->enum('model', ExportModels::EXPORTABLE_MODELS)->index();
            $table->enum('extension', Exports::TYPES);
            $table->enum('sender', Exports::SENDERS)->default('email');
            $table->string('email', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
