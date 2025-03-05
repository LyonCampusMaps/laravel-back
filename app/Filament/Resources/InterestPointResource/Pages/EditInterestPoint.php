<?php

namespace App\Filament\Resources\InterestPointResource\Pages;

use App\Filament\Resources\InterestPointResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInterestPoint extends EditRecord
{
    protected static string $resource = InterestPointResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
