<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourDayResource\Pages;
use App\Filament\Resources\TourDayResource\RelationManagers;
use App\Models\TourDay;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TourDayResource extends Resource
{
    protected static ?string $model = TourDay::class;
    protected static ?string $navigationGroup = 'Tour Details';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('day_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('tour_id')
                ->relationship('tour', 'title')
                ->searchable()
                ->preload()
                    ->required(),
                    Forms\Components\Select::make('drivers')
                    ->relationship('car', 'plate_number')
                    ->required(),    
                    
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
               
                Forms\Components\FileUpload::make('image')
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('day_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tour_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tenant_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image'),
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
            'index' => Pages\ListTourDays::route('/'),
            'create' => Pages\CreateTourDay::route('/create'),
            'edit' => Pages\EditTourDay::route('/{record}/edit'),
        ];
    }
}
