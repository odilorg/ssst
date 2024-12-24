<?php

namespace App\Filament\Resources\VehicleSubCategoryResource\Pages;

use App\Filament\Resources\VehicleSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVehicleSubCategories extends ListRecords
{
    protected static string $resource = VehicleSubCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
