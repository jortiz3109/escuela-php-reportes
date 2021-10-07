<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Merchant;
use App\Models\PaymentMethod;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseTestSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $usd = Currency::factory()->create(['alphabetic_code' => 'USD']);
        $cop = Currency::factory()->create(['alphabetic_code' => 'COP']);
        $visa = PaymentMethod::factory()->create(['name' => 'Visa']);
        $masterCard = PaymentMethod::factory()->create(['name' => 'Mastercard']);
        $merchant1 = Merchant::factory()->create([
            'name' => 'Merchant 1',
            'currency_id' => $cop->id,
        ]);
        $merchant2 = Merchant::factory()->create([
            'name' => 'Merchant 2',
            'currency_id' => $usd->id,
        ]);
        Transaction::factory(10)->create([
            'created_at' => '2021-01-01',
            'purchase_amount' => 15000,
            'currency_id' => $usd->id,
            'payment_method_id' => $visa->id,
            'merchant_id' => $merchant1,
        ]);
        Transaction::factory(10)->create([
            'created_at' => '2021-01-10',
            'purchase_amount' => rand(10000, 20000),
            'currency_id' => $usd->id,
            'payment_method_id' => $masterCard->id,
            'merchant_id' => $merchant1,
        ]);
        Transaction::factory(10)->create([
            'created_at' => '2021-01-10',
            'purchase_amount' => 15000,
            'currency_id' => $cop->id,
            'payment_method_id' => $visa->id,
            'merchant_id' => $merchant2,
        ]);
        Transaction::factory()->create([
            'created_at' => '2021-01-20',
            'purchase_amount' => 10000,
            'currency_id' => $usd->id,
            'payment_method_id' => $masterCard->id,
            'merchant_id' => $merchant1,
        ]);
        Transaction::factory()->create([
            'created_at' => '2021-01-20',
            'purchase_amount' => 20000,
            'currency_id' => $usd->id,
            'payment_method_id' => $masterCard->id,
            'merchant_id' => $merchant1,
        ]);
        Transaction::factory(10)->create([
            'created_at' => '2021-01-20',
            'purchase_amount' => rand(10000, 20000),
            'currency_id' => $usd->id,
            'payment_method_id' => $masterCard->id,
            'merchant_id' => $merchant2,
        ]);
    }
}
