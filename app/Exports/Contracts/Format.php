<?php

namespace App\Exports\Contracts;

use App\Models\Report;

interface Format
{
    public function fileName(): string;

    public function export(Report $report): void;

    public function write(array $data): void;

    public function formatter(array $data): array;

    public function setHeaders(array $columns): void;

    public function loadFile(): void;

    public function closeFile(): void;

    public function chunkSize() : int;
}
