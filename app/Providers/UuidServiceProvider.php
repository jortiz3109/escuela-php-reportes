<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\ColumnDefinition;
use Illuminate\Database\Schema\Grammars\Grammar;
use Illuminate\Support\Fluent;
use Illuminate\Support\ServiceProvider;

class UuidServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Grammar::macro('typeBinaryUuid', function (Fluent $column) {
            return sprintf('binary(%d)', $column->get('length'));
        });

        Blueprint::macro('binaryUuid', function (string $column, int $length = 36): ColumnDefinition {
            /* @var Blueprint $this */
            return $this->addColumn('binaryUuid', $column, ['length' => $length]);
        });
    }
}
