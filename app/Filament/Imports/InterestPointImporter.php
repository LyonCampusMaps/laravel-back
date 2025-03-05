<?php

namespace App\Filament\Imports;

use App\Models\InterestPoint;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class InterestPointImporter extends Importer
{
    protected static ?string $model = InterestPoint::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')->example('Example Name'),
            ImportColumn::make('category_id')->example(1),
            ImportColumn::make('address')->example('123 Example St.'),
            ImportColumn::make('latitude')->example(123.456),
            ImportColumn::make('longitude')->example(123.456),
            ImportColumn::make('attributes')->example('[{"attribute": "attribute1", "value": "value1"}, {"attribute": "attribute2", "value": "value2"}]'),
        ];
    }

    public function resolveRecord(): ?InterestPoint
    {
         return InterestPoint::firstOrNew([
                'name' => $this->data['name'],
                'address' => $this->data['address'],
         ]);
    }

    public function remapData(): void
    {
        parent::remapData();
        $this->data['attributes'] = json_decode($this->data['attributes'], true);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your interest point import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
