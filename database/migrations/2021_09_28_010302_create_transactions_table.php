<?php

use App\Constants\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('created_at')->default(now()->toDateTimeString());
            $table->string('reference', 50)->unique();
            $table->unsignedBigInteger('purchase_amount');
            $table->unsignedBigInteger('platform_amount');
            $table->string('pan', 20);
            $table->enum('status', Transaction::STATUSES)->index();
            $table->ipAddress('ip');
            $table->foreignId('device_id')->constrained('devices');
            $table->foreignId('payer_id')->constrained('payers');
            $table->foreignId('buyer_id')->constrained('buyers');
            $table->foreignId('merchant_id')->constrained('merchants');
            $table->unsignedTinyInteger('payment_method_id');
            $table->unsignedTinyInteger('currency_id');

            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
