<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleSubCategoryResource\Pages;
use App\Filament\Resources\VehicleSubCategoryResource\RelationManagers;
use App\Models\VehicleSubCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function Laravel\Prompts\form;

class VehicleSubCategoryResource extends Resource
{
    protected static ?string $model = VehicleSubCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                ->relationship('category', 'name')
                    ->required()
                    ->preload(),
                   // ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            //    Forms\Components\TextInput::make('price')
            //         ->required()
            //         ->numeric()
            //         ->maxLength(255),
            //    forms\Components\Select::make('type')
            //         ->relationship('type', 'name')
            //         ->required()
            //         ->default('hourly'),          
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListVehicleSubCategories::route('/'),
            'create' => Pages\CreateVehicleSubCategory::route('/create'),
            'edit' => Pages\EditVehicleSubCategory::route('/{record}/edit'),
        ];
    }
}
