<?php

namespace App\Filament\Resources\AirRailResource\Pages;

use App\Filament\Resources\AirRailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAirRails extends ListRecords
{
    protected static string $resource = AirRailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
