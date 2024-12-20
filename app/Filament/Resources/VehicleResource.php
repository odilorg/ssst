<?php

namespace App\Filament\Resources;

use App\Models\Vehicle;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Resources\VehicleResource\Pages;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Driver and Guide Details';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('license_plate')
                    ->label('License Plate')
                    ->required()
                    ->maxLength(255),

                Select::make('owner_type')
                    ->label('Owner Type')
                    ->options([
                        'driver' => 'Driver',
                        'company' => 'Company',
                    ])
                    ->required()
                    ->reactive(),

                    Forms\Components\Select::make('owner_id')
                    ->label('Owner')
                    ->options(function ($get) {
                        $ownerType = $get('owner_type');
                        return $ownerType === 'driver'
                            ? \App\Models\Driver::pluck('name', 'id')
                            : \App\Models\Company::pluck('name', 'id');
                    })
                    ->required()
                    ->searchable(),

                Select::make('type')
                    ->label('Vehicle Type')
                    ->options([
                        'car' => 'Car',
                        'bus' => 'Bus',
                    ])
                    ->required(),

                TextInput::make('make')
                    ->label('Make')
                    ->required()
                    ->maxLength(255),

                TextInput::make('model')
                    ->label('Model')
                    ->required()
                    ->maxLength(255),

                TextInput::make('color')
                    ->label('Color')
                    ->required()
                    ->maxLength(50),

                FileUpload::make('image')
                    ->label('Vehicle Image')
                    ->image()
                    ->directory('vehicles')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('license_plate')
                    ->label('License Plate')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Type')
                    ->sortable(),

                TextColumn::make('make')
                    ->label('Make')
                    ->sortable(),

                TextColumn::make('model')
                    ->label('Model')
                    ->sortable(),

                TextColumn::make('color')
                    ->label('Color'),

                ImageColumn::make('image')
                    ->label('Image')
                    ->circular()
                    ->width(50)
                    ->height(50),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Add filters if necessary
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define additional relations if necessary
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
