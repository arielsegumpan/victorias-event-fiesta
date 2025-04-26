<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Fiesta;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\FiestaResource\Pages;
use App\Filament\Admin\Resources\FiestaResource\RelationManagers;
use Filament\Forms\Components\TextInput;

class FiestaResource extends Resource
{
    protected static ?string $model = Fiesta::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make()
                ->schema([
                    Select::make('created_by')
                    ->label('Created By')
                    ->relationship(name: 'user', titleAttribute:'name', ignoreRecord: true)
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->optionsLimit(6),

                    Select::make('category_id')
                    ->label('Category')
                    ->relationship(name: 'category', titleAttribute:'cat_name', ignoreRecord: true)
                    ->required()
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->optionsLimit(6),

                    TextInput::make('f_name')
                    ->label('Fiesta Name')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),



                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListFiestas::route('/'),
            'create' => Pages\CreateFiesta::route('/create'),
            'edit' => Pages\EditFiesta::route('/{record}/edit'),
        ];
    }
}
