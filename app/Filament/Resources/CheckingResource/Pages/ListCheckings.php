<?php

namespace App\Filament\Resources\CheckingResource\Pages;

use App\Filament\Resources\CheckingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCheckings extends ListRecords
{
    protected static string $resource = CheckingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
