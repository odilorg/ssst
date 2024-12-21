<?php
namespace App\Filament\Resources;

use App\Filament\Resources\AirRailResource\Pages;
use App\Models\AirRail;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class AirRailResource extends Resource
{
    protected static ?string $model = AirRail::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Type')
                    ->options(['plane' => 'Plane', 'train' => 'Train'])
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('departure_location')
                    ->required(),
                Forms\Components\TextInput::make('arrival_location')
                    ->required(),
                Forms\Components\DateTimePicker::make('departure_time')
                    ->required(),
                Forms\Components\DateTimePicker::make('arrival_time')
                    ->nullable(),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('seat_class')
                    ->nullable(),
               
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')->sortable(),
                Tables\Columns\TextColumn::make('name')->sortable(),
                Tables\Columns\TextColumn::make('departure_location')->sortable(),
                Tables\Columns\TextColumn::make('arrival_location')->sortable(),
                Tables\Columns\TextColumn::make('departure_time')->sortable(),
                Tables\Columns\TextColumn::make('arrival_time')->sortable(),
                Tables\Columns\TextColumn::make('price')->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAirRails::route('/'),
            'create' => Pages\CreateAirRail::route('/create'),
            'edit' => Pages\EditAirRail::route('/{record}/edit'),
        ];
    }
}
