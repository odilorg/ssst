<?php

namespace App\Filament\Resources\AirRailResource\Pages;

use App\Filament\Resources\AirRailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAirRail extends EditRecord
{
    protected static string $resource = AirRailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
