<?php

namespace App\Filament\Resources\GuidePriceResource\Pages;

use App\Filament\Resources\GuidePriceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGuidePrice extends EditRecord
{
    protected static string $resource = GuidePriceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
