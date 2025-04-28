<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use App\Models\Barangay;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\BarangayResource\Pages;
use App\Filament\Admin\Resources\BarangayResource\RelationManagers;

class BarangayResource extends Resource
{
    protected static ?string $model = Barangay::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make()
                ->schema([

                    TextInput::make('brgy_name')
                    ->label('Barangay')
                    ->required()
                    ->maxLength(255)
                    ->unique(Barangay::class, 'brgy_slug', ignoreRecord: true)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('brgy_slug', Str::slug($state))),

                    TextInput::make('brgy_slug')
                    ->label('Slug')
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->maxLength(255)
                    ->unique(Barangay::class, 'brgy_slug', ignoreRecord: true),

                    Group::make([
                        ToggleButtons::make('is_published')
                        ->label('Is Publish?')
                        ->inline()
                        ->required()
                        ->options([
                            '1' => 'Yes',
                            '0' => 'No',
                        ])
                        ->icons([
                            '1' => 'heroicon-o-check-circle',
                            '0' => 'heroicon-o-x-circle',
                        ])
                        ->colors([
                            '1' => 'primary',
                            '0' => 'danger',
                        ])
                        ->default('1'),

                        ToggleButtons::make('is_featured')
                        ->label('Is Featured?')
                        ->inline()
                        ->required()
                        ->options([
                            '1' => 'Yes',
                            '0' => 'No',
                        ])
                        ->icons([
                            '1' => 'heroicon-o-check-circle',
                            '0' => 'heroicon-o-x-circle',
                        ])
                        ->colors([
                            '1' => 'primary',
                            '0' => 'danger',
                        ])
                        ->default('1'),
                    ])
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 2,
                    ]),

                    RichEditor::make('brgy_desc')
                    ->label('Description')
                    ->maxLength(65535)
                    ->columnSpanFull()
                ])
                ->columnSpan([
                    'sm' => 1,
                    'md' => 3,
                    'lg' => 3,
                ]),

                Section::make()
                ->schema([

                    Fieldset::make('Barangay Logo')
                    ->schema([
                        FileUpload::make('brgy_logo')
                        ->hiddenlabel()
                        ->image()
                        ->required()
                        ->maxSize(1024)
                        ->columnSpanFull(),
                    ]),

                    Fieldset::make('Barangay Image Gallery')
                    ->schema([
                        FileUpload::make('brgy_img_gallery')
                        ->hiddenlabel()
                        ->multiple()
                        ->image()
                        ->maxSize(1024*5)
                        ->columnSpanFull(),
                    ])
                ])
                ->columnSpan([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2,
                ])


            ])
            ->columns([
                'sm' => 1,
                'md' => 5,
                'lg' => 5,
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->tooltip('Actions')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->deferLoading()
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label(__('New Barangay')),
            ])
            ->emptyStateIcon('heroicon-o-home-modern')
            ->emptyStateHeading('No barangays are created')
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListBarangays::route('/'),
            'create' => Pages\CreateBarangay::route('/create'),
            'edit' => Pages\EditBarangay::route('/{record}/edit'),
        ];
    }
}
