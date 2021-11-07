<?php

use App\Constants\ExportTypes;
use App\Constants\Exports;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ExportTypes::EXPORTABLE_TYPES)->index();
            $table->enum('extension', Exports::TYPES);
            $table->timestamp('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
}
