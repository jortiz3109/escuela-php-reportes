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
            $table->binaryUuid('uuid')->unique();
            $table->string('reference', 50)->unique();
            $table->unsignedBigInteger('purchase_amount')->index();
            $table->unsignedBigInteger('platform_amount')->index();
            $table->string('truncated_pan', 20)->index();
            $table->enum('status', Transactions::STATUSES)->index();
            $table->ipAddress('ip');
            $table->unsignedBigInteger('device_id');
            $table->unsignedBigInteger('payer_id');
            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('merchant_id');
            $table->unsignedTinyInteger('payment_method_id');
            $table->unsignedTinyInteger('currency_id');
            $table->unsignedTinyInteger('country_id');
            $table->timestamp('created_at')->index();

            $table->foreign('device_id')->references('id')->on('devices');
            $table->foreign('payer_id')->references('id')->on('payers');
            $table->foreign('buyer_id')->references('id')->on('buyers');
            $table->foreign('merchant_id')->references('id')->on('merchants');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('country_id')->references('id')->on('countries');

            $table->index(['reference', 'status', 'merchant_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
}
