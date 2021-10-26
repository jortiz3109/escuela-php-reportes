<?php

use App\Constants\ExportModels;
use App\Constants\Fields;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldsTable extends Migration
{
    public function up(): void
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->enum('table_name', array_keys(ExportModels::EXPORTABLE_MODELS));
            $table->char('priority', 3)->nullable();
            $table->enum('order', [Fields::ORDER_ASC, Fields::ORDER_DESC])->default(Fields::ORDER_ASC);
            $table->enum('operator', Fields::OPERATORS)->nullable();
            $table->string('value', 100)->nullable();
            $table->foreignId('report_id')->constrained('reports');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
}
