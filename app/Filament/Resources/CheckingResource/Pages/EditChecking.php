<?php

namespace App\Filament\Resources\CheckingResource\Pages;

use App\Filament\Resources\CheckingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChecking extends EditRecord
{
    protected static string $resource = CheckingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
