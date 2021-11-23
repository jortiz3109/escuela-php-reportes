<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CurrenciesTableSeeder extends Seeder
{
    public function run(): void
    {
        $currencies = json_decode(Storage::disk('docs')->get('currency-codes.json'), true);
        foreach ($currencies as $currency) {
            Currency::query()->firstOrCreate([
                'alphabetic_code' => $currency['AlphabeticCode'],
            ], [
                'alphabetic_code' => $currency['AlphabeticCode'],
                'numeric_code' => str_pad($currency['NumericCode'], 3, '0', STR_PAD_LEFT),
                'minor_unit' => preg_match('/^\d+$/', $currency['MinorUnit']) ? $currency['MinorUnit'] : null,
            ]);
        }
    }
}
