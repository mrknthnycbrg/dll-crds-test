<?php

namespace App\Filament\Exports;

use App\Models\Department;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class DepartmentExporter extends Exporter
{
    protected static ?string $model = Department::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name')
                ->label('Name'),
            ExportColumn::make('abbreviation')
                ->label('Abbreviation'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your department export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
