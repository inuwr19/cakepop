<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CakeResource\Pages;
use App\Filament\Resources\CakeResource\RelationManagers;
use App\Models\Cake;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CakeResource extends Resource
{
    protected static ?string $model = Cake::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('description')
                ->maxLength(500),
            TextInput::make('price')
                ->numeric()
                ->required(),
            TextInput::make('size'),
            FileUpload::make('image'),
            Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('description')->limit(50),
                TextColumn::make('price')->money('IDR'),
                TextColumn::make('size'),
                ImageColumn::make('image')
                ->rounded(),
                TextColumn::make('category.name')
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
            'index' => Pages\ListCakes::route('/'),
            'create' => Pages\CreateCake::route('/create'),
            'edit' => Pages\EditCake::route('/{record}/edit'),
        ];
    }
}
