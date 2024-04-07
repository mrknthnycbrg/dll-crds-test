<?php

namespace App\Filament\Exports;

use App\Models\Adviser;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class AdviserExporter extends Exporter
{
    protected static ?string $model = Adviser::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name')
                ->label('Name'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your adviser export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
