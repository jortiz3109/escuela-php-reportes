<?php

namespace App\Exports\Contracts;

use App\Helpers\FieldsHelper;
use App\Models\QueryReport;
use App\Models\Report;
use Illuminate\Support\Collection;

abstract class ExportBase implements Export
{
    /**
     * @var bool|resource
     */
    protected $fileStream;

    public function export(Report $report): void
    {
        $this->loadFile();
        $fields = $report->fields->toArray();
        $this->setHeaders(FieldsHelper::getFieldsNames($fields));
        QueryReport::filter($fields)->chunk($this->chunkSize(), function (Collection $collection) {
            foreach ($collection->toBase()->toArray() as $row) {
                $this->write($row);
            }
        });
        $this->closeFile();
    }

    public function fileName(): string
    {
        return storage_path('app/reports/report_' . now()->timestamp . static::EXT);
    }

    public function write(array $data): void
    {
        fputcsv($this->fileStream, $this->formatter($data), $this->getDelimiter());
    }

    public function setHeaders(array $columns): void
    {
        $columns = array_map(fn ($column) => trans('columns.' . $column), $columns);
        $this->write($columns);
    }

    public function formatter(array $data): array
    {
        return $data;
    }

    public function loadFile(): void
    {
        $this->fileStream = fopen($this->fileName(), 'a');
    }

    public function closeFile(): void
    {
        fclose($this->fileStream);
    }

    public function chunkSize(): int
    {
        return config('exports.chunk');
    }

    abstract protected function getDelimiter(): string;
}
