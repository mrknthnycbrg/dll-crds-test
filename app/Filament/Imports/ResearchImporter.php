<?php

namespace App\Filament\Imports;

use App\Models\Research;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ResearchImporter extends Importer
{
    protected static ?string $model = Research::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('title')
                ->label('Title')
                ->requiredMapping(),
            ImportColumn::make('author')
                ->label('Authors'),
            ImportColumn::make('keyword')
                ->label('Keywords'),
            ImportColumn::make('abstract')
                ->label('Abstract'),
            ImportColumn::make('date_submitted')
                ->label('Date Submitted')
                ->rules(['date']),
            ImportColumn::make('department')
                ->label('Department')
                ->relationship(resolveUsing: 'name'),
            ImportColumn::make('adviser')
                ->label('Adviser')
                ->relationship(resolveUsing: 'name'),
        ];
    }

    public function resolveRecord(): ?Research
    {
        return Research::firstOrNew([
            'title' => $this->data['title'],
        ]);

        return new Research();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your research import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
