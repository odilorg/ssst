<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;

use Filament\Tables\Table;
use Filament\Resources\Resource;
use Spatie\Permission\Models\Role;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MultiSelect;
use App\Filament\Resources\RoleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Filament\Resources\RoleResource\RelationManagers\PermissionsRelationManager;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;
    protected static bool $shouldRegisterNavigation = false;



    protected static ?string $navigationIcon = 'heroicon-s-cog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->unique(ignoreRecord:true)
                ->maxLength(255),
             Select::make('permissions')
                ->relationship('permissions', 'name') 
                ->multiple()
                ->preload()
                ->searchable() 
                ->required() 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable(),
                TextColumn::make('permissions.name')
                    // ->listWithLineBreaks()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            PermissionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
