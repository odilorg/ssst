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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                            ->relationship('tourDays') // Define relationship to TourDays model
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
                                    ->description('Assign Driver and Vehicle')
                                    ->schema([
                                        Forms\Components\Select::make('driver_id')
                                            ->label('Driver')
                                            ->relationship('driver', 'name') // Populate drivers dynamically
                                            ->required()
                                            ->reactive(),

                                        Forms\Components\Select::make('vehicle_id')
                                            ->label('Vehicle')
                                            ->options(function (callable $get) {
                                                $driverId = $get('driver_id');
                                                return $driverId
                                                    ? \App\Models\Vehicle::whereHas('drivers', function ($query) use ($driverId) {
                                                        $query->where('drivers.id', $driverId);
                                                    })->pluck('license_plate', 'id')
                                                    : [];
                                            })
                                            ->required()
                                            ->placeholder('Select a vehicle'),
                                    ]),
                                Forms\Components\Section::make('Guide Monument Details')
                                    ->description('Assign Guide and Monuments')
                                    ->schema([
                                        Forms\Components\Select::make('monuments')
                                            ->relationship('monuments', 'name')
                                            ->multiple()
                                            ->preload(),
                                        Forms\Components\Select::make('guide')
                                            ->relationship('guide', 'full_name')
                                            //->multiple()
                                            ->preload(),
                                        Forms\Components\Select::make('hotel')
                                            ->relationship('hotel', 'name')
                                            //->multiple()
                                            ->preload()    

                                    ]),
                                    Forms\Components\Section::make('Air and Rail Details')
                                    ->description('Assign Air and Rail Transportation')
                                    ->schema([
                                        Forms\Components\Select::make('air_rails')
                                            ->label('Air or Rail')
                                            ->relationship('airRails', 'name') // Correct relationship for the many-to-many association
                                            ->multiple() // Allows selecting multiple AirRail records
                                            ->preload()
                                            ->searchable(),
                                        Forms\Components\Repeater::make('air_rails_details') // Handling details for the pivot table
                                            ->label('Air Rail Details')
                                            ->relationship('airRails') // Reflects the correct relationship
                                            ->schema([
                                                Forms\Components\TextInput::make('departure_time_override')
                                                    ->label('Departure Time Override')
                                                    ->type('datetime-local')
                                                    ->nullable(),
                                                Forms\Components\TextInput::make('arrival_time_override')
                                                    ->label('Arrival Time Override')
                                                    ->type('datetime-local')
                                                    ->nullable(),
                                                Forms\Components\TextInput::make('ticket_number')
                                                    ->label('Ticket Number')
                                                    ->nullable(),
                                                Forms\Components\Textarea::make('special_requests')
                                                    ->label('Special Requests')
                                                    ->nullable(),
                                            ])
                                            ->columns(2),
                                    ])
                                
                            ])
                            ->columnSpan(1),
                    ]),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tour_duration')
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
                // Add filters here if needed
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

                Section::make('Tour Prices')
                    ->schema([
                        RepeatableEntry::make('tourPrices')
                            ->schema([
                                TextEntry::make('number_people'),
                                TextEntry::make('tour_price'),
                            ])->columns(2),
                    ])->columns(2),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define any additional relations
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
