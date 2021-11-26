<?php

namespace App\Exports\Formats;

use App\Exports\Contracts\Format;
use App\Helpers\FieldsHelper;
use App\Models\QueryReport;
use App\Models\Report;
use ExcelMerge\ExcelMerge;
use Illuminate\Cache\Repository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as Excel;

class XLSX implements Format
{
    private const EXT = '.xlsx';

    private Spreadsheet $doc;

    private int $row = 0;

    private int $worksheetIndex = 0;

    private array $files = [];

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function export(Report $report): void
    {
        $this->setCache();
        $fields = $report->fields->toArray();
        QueryReport::filter($report->fields->toArray())->chunk(
            $this->chunkSize(),
            function (Collection $collection) use ($fields) {
                $this->worksheetIndex++;
                $this->loadFile();
                $this->setHeaders(FieldsHelper::getFieldsNames($fields));
                foreach ($collection->toBase()->toArray() as $row) {
                    $this->write($row);
                }
                $this->closeFile();
                $this->doc->disconnectWorksheets();
                array_push($this->files, $this->tempFile());
                unset($this->doc);
                unset($this->sheet);
            }
        );
        $this->mergeSheets();
        $this->cleanTmpFiles();
    }

    private function mergeSheets(): void
    {
        $merged = new ExcelMerge($this->files);
        $merged->save($this->fileName());
    }

    private function cleanTmpFiles(): void
    {
        foreach ($this->files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    public function write(array $data): void
    {
        $this->sheet->fromArray($this->formatter($data), startCell: 'A' . $this->getCurrentRow());
        $this->row++;
    }

    public function formatter(array $data): array
    {
        return $data;
    }

    public function fileName(): string
    {
        return storage_path('app/reports/report_' . now()->timestamp . self::EXT);
    }

    public function setHeaders(array $columns): void
    {
        $this->sheet->setTitle($this->row . '-' . $this->row + $this->chunkSize());
        $columns = array_map(fn ($column) => trans('columns.' . $column), $columns);
        $this->sheet->fromArray($columns);
    }

    public function loadFile(): void
    {
        $this->doc = new Spreadsheet();
        $this->sheet = $this->doc->getActiveSheet();
    }

    public function setCache(): void
    {
        $cacheStore = Cache::getStore();
        $cacheInterface = new Repository($cacheStore);
        Settings::setCache($cacheInterface);
    }

    /**
     * @throws Exception
     */
    public function closeFile(): void
    {
        $writer = new Excel($this->doc);
        $writer->setPreCalculateFormulas(false);
        $writer->save($this->tempFile());
    }

    private function tempFile(): string
    {
        return storage_path('app/reports/tmp/' . $this->worksheetIndex . self::EXT);
    }

    private function getCurrentRow(): int
    {
        $currentRow = $this->row > $this->chunkSize() ? $this->worksheetIndex * $this->chunkSize() - $this->row : $this->row;
        return $currentRow < 2 ? 2 : $currentRow;
    }

    public function chunkSize(): int
    {
        return config('exports.chunk');
    }
}
