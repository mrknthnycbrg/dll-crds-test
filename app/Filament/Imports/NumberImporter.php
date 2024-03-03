<?php

namespace App\Filament\Imports;

use App\Models\Number;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class NumberImporter extends Importer
{
    protected static ?string $model = Number::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('id_number')
                ->label('ID Number')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
        ];
    }

    public function resolveRecord(): ?Number
    {
        return Number::firstOrNew([
            'id_number' => $this->data['id_number'],
        ]);

        return new Number();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your number import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
