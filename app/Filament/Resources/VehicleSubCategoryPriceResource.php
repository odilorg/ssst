<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleSubCategoryPriceResource\Pages;
use App\Filament\Resources\VehicleSubCategoryPriceResource\RelationManagers;
use App\Models\VehicleSubCategoryPrice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleSubCategoryPriceResource extends Resource
{
    protected static ?string $model = VehicleSubCategoryPrice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('vehicle_sub_category_id')
                ->relationship('subCategory', 'name')
                    ->required()
                    ->preload(),
                    Forms\Components\Select::make('type')
                    ->options([
                        
                        'daily' => 'Daily',
                        'per_pickup_dropoff' => 'Pick/Drop',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subCategory.category.name')
                   // ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subCategory.name')
                  //  ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicleSubCategoryPrices::route('/'),
            'create' => Pages\CreateVehicleSubCategoryPrice::route('/create'),
            'edit' => Pages\EditVehicleSubCategoryPrice::route('/{record}/edit'),
        ];
    }
}
