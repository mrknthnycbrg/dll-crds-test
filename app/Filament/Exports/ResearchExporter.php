<?php

namespace App\Filament\Exports;

use App\Models\Research;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ResearchExporter extends Exporter
{
    protected static ?string $model = Research::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('title')
                ->label('Title'),
            ExportColumn::make('author')
                ->label('Authors'),
            ExportColumn::make('keyword')
                ->label('Keywords'),
            ExportColumn::make('abstract')
                ->label('Abstract'),
            ExportColumn::make('date_submitted')
                ->label('Date Submitted'),
            ExportColumn::make('department.name')
                ->label('Department'),
            ExportColumn::make('adviser.name')
                ->label('Adviser'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your research export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
