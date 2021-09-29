<?php

use App\Constants\ExportModels;
use App\Constants\Fields;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->enum('table_name', ExportModels::EXPORTABLE_MODELS);
            $table->char('order_field', 3)->nullable();
            $table->enum('order_data', [Fields::ORDER_ASC, Fields::ORDER_DESC])->nullable();
            $table->enum('operator', Fields::OPERATORS)->nullable();
            $table->string('value', 100)->nullable();
            $table->foreignId('report_id')->constrained('reports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fields');
    }
}
