<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopsResource\Pages;
use App\Filament\Resources\ShopsResource\RelationManagers;
use App\Models\Shop;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;


class ShopsResource extends Resource
{
    protected static ?string $model = Shop::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // TextInput::make('shop_id'),
                TextInput::make('shop_title'),
                TextInput::make('shop_id'),
                TextInput::make('cluster'),
                TextInput::make('api_key'),
                TextInput::make('api_secret'),
                TextInput::make('main_language'),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('shop_id'),
                TextColumn::make('cluster'),
                TextColumn::make('api_key'),
                TextColumn::make('api_secret'),
                TextColumn::make('main_language'),
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
            'index' => Pages\ListShops::route('/'),
            'create' => Pages\CreateShops::route('/create'),
            'edit' => Pages\EditShops::route('/{record}/edit'),
        ];
    }
}
