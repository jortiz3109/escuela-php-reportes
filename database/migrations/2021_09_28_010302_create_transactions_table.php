<?php

use App\Constants\Transactions;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('reference', 50)->unique();
            $table->unsignedBigInteger('purchase_amount');
            $table->unsignedBigInteger('platform_amount');
            $table->string('truncated_pan', 20);
            $table->enum('status', Transactions::STATUSES)->index();
            $table->ipAddress('ip')->index();
            $table->foreignUuid('device_uuid')->constrained('devices', 'uuid');
            $table->foreignUuid('payer_uuid')->nullable()->constrained('payers', 'uuid');
            $table->foreignUuid('buyer_uuid')->nullable()->constrained('buyers', 'uuid');
            $table->foreignUuid('merchant_uuid')->constrained('merchants', 'uuid');
            $table->foreignUuid('payment_method_uuid')->constrained('payment_methods', 'uuid');
            $table->foreignUuid('currency_uuid')->constrained('currencies', 'uuid');
            $table->foreignUuid('country_uuid')->constrained('countries', 'uuid');
            $table->timestamp('created_at')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
}
