<?php

namespace App\Filament\Resources\VehicleSubCategoryPriceResource\Pages;

use App\Filament\Resources\VehicleSubCategoryPriceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicleSubCategoryPrice extends EditRecord
{
    protected static string $resource = VehicleSubCategoryPriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
