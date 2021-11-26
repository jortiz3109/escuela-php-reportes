<?php

use App\Constants\Devices;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->binaryUuid('uuid')->unique();
            $table->string('browser', 50)->index();
            $table->string('os', 100)->index();
            $table->enum('device_type', Devices::TYPES)->index();
            $table->timestamp('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
}
