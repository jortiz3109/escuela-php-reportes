<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->char('minute', 2)->default('*');
            $table->char('hour', 2)->default('*');
            $table->char('day_month', 2)->default('*');
            $table->char('month', 2)->default('*');
            $table->char('day_week', 2)->default('*');
            $table->foreignId('report_id')->constrained('reports');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
}
