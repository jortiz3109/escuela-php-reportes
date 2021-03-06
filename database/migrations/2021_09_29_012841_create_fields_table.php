<?php

use App\Constants\ExportTypes;
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
            $table->enum('table_name', ExportTypes::EXPORTABLE_TABLES);
            $table->enum('order', [Fields::ORDER_ASC, Fields::ORDER_DESC])->nullable();
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
