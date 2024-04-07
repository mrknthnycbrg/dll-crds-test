<?php

namespace App\Filament\Imports;

use App\Models\Department;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Str;

class DepartmentImporter extends Importer
{
    protected static ?string $model = Department::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->label('Name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('abbreviation')
                ->label('Abbreviation')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
        ];
    }

    public function resolveRecord(): ?Department
    {
        return Department::firstOrNew([
            'slug' => Str::slug($this->data['name']),
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your department import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
