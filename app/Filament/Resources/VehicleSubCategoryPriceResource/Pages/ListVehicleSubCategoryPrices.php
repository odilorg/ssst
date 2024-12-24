<?php

namespace App\Filament\Resources\VehicleSubCategoryPriceResource\Pages;

use App\Filament\Resources\VehicleSubCategoryPriceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleSubCategoryPrices extends ListRecords
{
    protected static string $resource = VehicleSubCategoryPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
