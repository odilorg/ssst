<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuidePriceResource\Pages;
use App\Filament\Resources\GuidePriceResource\RelationManagers;
use App\Models\GuidePrice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GuidePriceResource extends Resource
{
    protected static ?string $model = GuidePrice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('spok_lang_id')
                ->relationship('availLanguages', 'language')
                    ->required()
                    ->preload(),
                Forms\Components\TextInput::make('price')
                ->label('Price per Day')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
                Tables\Columns\TextColumn::make('availLanguages.language')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListGuidePrices::route('/'),
            'create' => Pages\CreateGuidePrice::route('/create'),
            'edit' => Pages\EditGuidePrice::route('/{record}/edit'),
        ];
    }
}
