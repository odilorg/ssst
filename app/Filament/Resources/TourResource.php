<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Tour;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Repeater;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\TourResource\Pages;
use Filament\Infolists\Components\RepeatableEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TourResource\RelationManagers;

class TourResource extends Resource
{
    protected static ?string $model = Tour::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-americas';

    protected static ?string $navigationGroup = 'Tour Details';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Tour')
                    ->description('Add Tour')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('tour_duration')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('tour_description')
                            ->required()
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Tour Days')
                    ->description('Add Tour Days')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Repeater::make('tourDays')
    ->label('Tour Days')
    ->relationship()
    ->schema([
        Forms\Components\TextInput::make('day_name')
            ->required()
            ->maxLength(255),

        Forms\Components\Textarea::make('description')
            ->required()
            ->columnSpanFull(),

        Forms\Components\FileUpload::make('image')
            ->image(),

        Forms\Components\Section::make('Transportation Details')
            ->description('Assign Driver and Car')
            ->schema([
                Forms\Components\Select::make('driver_id')
                    ->label('Driver')
                    ->options(\App\Models\Driver::pluck('full_name', 'id')) // Populate drivers
                    ->required()
                    ->reactive(),

                Forms\Components\Select::make('car_id')
                    ->label('Car')
                    ->options(function ($get) {
                        $driverId = $get('driver_id');
                        return $driverId
                            ? \App\Models\Car::whereHas('drivers', function ($query) use ($driverId) {
                                $query->where('drivers.id', $driverId);
                            })->pluck('plate_number', 'id')
                            : [];
                    })
                    ->required()
                    ->placeholder('Select a car')
                    ->afterStateUpdated(function ($state, $set, $record) {
                        if (isset($state['driver_id'], $state['car_id'])) {
                            $tourDay = \App\Models\TourDay::find($record->id);
                            if ($tourDay) {
                                $tourDay->drivers()->syncWithoutDetaching([$state['driver_id']]);
                                $tourDay->cars()->syncWithoutDetaching([$state['car_id']]);
                            }
                        }
                    }),
            ]),
        Forms\Components\Select::make('monuments')
            ->relationship('monuments', 'name')
            ->required()
            ->multiple()
            ->preload(),
        Forms\Components\Select::make('hotels')
            ->relationship('hotels', 'name')
            ->required()
            ->multiple()
            ->preload(),
        Forms\Components\Select::make('guides')
            ->relationship('guides', 'full_name')
            ->required()
            ->multiple()
            ->preload(),
    ])
    ->columnSpan(1),

                    ]),

                Forms\Components\Section::make('Tour Prices')
                    ->description('Add Tour Prices')
                    ->collapsible()
                    ->schema([
                        Repeater::make(name: 'tourPrices')
                            ->label('Tour Prices')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('number_people')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('tour_price')
                                    ->prefix('$')
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->numeric(),

                            ])->columnSpan(1),
                    ]),

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
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tour_duration')
                    ->searchable(),


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist


            ->schema([

                Section::make('Tour Info')
                    ->schema([
                        TextEntry::make('title'),
                        TextEntry::make('tour_duration'),
                    ])->columns(2),

                Section::make(heading: 'Tour Prices')
                    ->schema([

                        RepeatableEntry::make('tourPrices')
                            ->schema([
                                TextEntry::make('number_people'),
                                TextEntry::make('tour_price')
                            ])->columns(2)
                    ])->columns(2)


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
            'index' => Pages\ListTours::route('/'),
            'create' => Pages\CreateTour::route('/create'),
            'edit' => Pages\EditTour::route('/{record}/edit'),
        ];
    }
}
