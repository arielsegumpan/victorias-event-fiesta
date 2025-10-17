<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use App\Models\Barangay;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Split;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Group as InfoG;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Section as InfoSec;
use App\Filament\Admin\Resources\BarangayResource\Pages;
use App\Filament\Admin\Resources\BarangayResource\RelationManagers;
use App\Filament\Admin\Resources\BarangayResource\Pages\EditBarangay;
use App\Filament\Admin\Resources\BarangayResource\Pages\ViewBarangay;

class BarangayResource extends Resource
{
    protected static ?string $model = Barangay::class;

    protected static ?string $navigationIcon = 'phosphor-buildings';

    protected static ?int $navigationSort = 1;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make()
                ->schema([

                    Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Brgy. Details')
                            ->icon('phosphor-info')
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
                                        '1' => 'phosphor-check-circle',
                                        '0' => 'phosphor-x-circle',
                                    ])
                                    ->colors([
                                        '1' => 'primary',
                                        '0' => 'danger',
                                    ])
                                    ->dehydrated()
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
                                        '1' => 'phosphor-check-circle',
                                        '0' => 'phosphor-x-circle',
                                    ])
                                    ->colors([
                                        '1' => 'primary',
                                        '0' => 'danger',
                                    ])
                                    ->dehydrated()
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
                            ]),
                        Tabs\Tab::make('Address')
                            ->icon('phosphor-map-pin')
                            ->schema([
                                TextInput::make('brgy_address')
                                ->label('Address')
                                ->maxlength(255)
                                ->required(),

                                TextInput::make('brgy_contact')
                                ->label('Contact')
                                ->required(),

                                TextInput::make('brgy_email')
                                ->label('Email')
                                ->email()
                                ->required(),


                            ]),
                        Tabs\Tab::make('Socmeds')
                            ->icon('phosphor-globe-hemisphere-east')
                            ->schema([
                                TextInput::make('brgy_facebook')
                                ->label('Facebook')
                                ->maxlength(255)
                                ->url()
                                ->prefixIcon('phosphor-facebook-logo')
                                ->nullable(),

                                TextInput::make('brgy_twitter')
                                ->label('Twitter')
                                ->maxlength(255)
                                ->url()
                                ->prefixIcon('phosphor-twitter-logo')
                                ->nullable(),

                                TextInput::make('brgy_instagram')
                                ->label('Instagram')
                                ->maxlength(255)
                                ->url()
                                ->prefixIcon('phosphor-instagram-logo')
                                ->nullable(),

                                TextInput::make('brgy_youtube')
                                ->label('Youtube')
                                ->maxlength(255)
                                ->url()
                                ->prefixIcon('phosphor-youtube-logo'),

                                TextInput::make('brgy_tiktok')
                                ->label('Tiktok')
                                ->maxlength(255)
                                ->url()
                                ->prefixIcon('phosphor-tiktok-logo')
                                ->nullable(),
                            ]),
                    ])
                    ->contained(false),

                ])
                ->columnSpan([
                    'sm' => 1,
                    'md' => 3,
                    'lg' => 3,
                ]),

                Group::make([
                    // Section::make()
                    // ->schema([
                    //     Section::make('Barangay Captain Assignment')
                    //     ->schema([
                    //         Select::make('barangay_captain_id')
                    //         ->label('Assign Barangay Captain')
                    //         ->options(function () {
                    //             return \App\Models\User::whereHas('roles', function ($query) {
                    //                 $query->whereIn('name', [
                    //                     'barangay captain',
                    //                     'barangay_captain',
                    //                     'brgy captain',
                    //                     'brgy_captain',
                    //                     'captain',
                    //                 ]);
                    //             })
                    //             ->pluck('name', 'id');
                    //         })
                    //         ->searchable()
                    //         ->preload()
                    //         ->native(false)
                    //         ->required()
                    //         ->afterStateHydrated(function (Select $component, $state, $record) {
                    //             // Load current captain when editing
                    //             if ($record && $record->currentCaptain) {
                    //                 $component->state($record->currentCaptain->user_id);
                    //             }
                    //             // if ($record) {
                    //             //     $currentCaptain = $record->currentCaptain;
                    //             //     if ($currentCaptain) {
                    //             //         $component->state($currentCaptain->user_id);
                    //             //     }
                    //             // }
                    //         })
                    //         ->dehydrated(false)
                    //         ->helperText(fn ($record) => $record && $record->currentCaptain
                    //             ? 'Current captain since: ' . $record->currentCaptain->term_start->format('M d, Y')
                    //             : null
                    //         ),
                    //     ])
                    // ]),


                    Section::make()
                    ->schema([

                        Fieldset::make('Barangay Logo')
                        ->schema([
                            FileUpload::make('brgy_logo')
                            ->hiddenlabel()
                            ->image()
                            ->required()
                            ->maxSize(1024)
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->columnSpanFull(),
                        ]),

                        Fieldset::make('Barangay Image Gallery')
                        ->schema([
                            FileUpload::make('brgy_img_gallery')
                            ->hiddenlabel()
                            ->multiple()
                            ->image()
                            ->maxSize('2048')
                            ->maxParallelUploads(5)
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                            ->columnSpanFull(),
                        ]),

                    ]),


                ])
                ->columnSpan([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 2,
                ]),

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

                ImageColumn::make('brgy_logo')
                    ->label('Logo')
                    ->square()
                    ->size(50)
                    ->placeholder('No Image'),

                ImageColumn::make('brgy_img_gallery')
                    ->label('Galleries')
                    ->circular()
                    ->size(50)
                    ->placeholder('No Image')
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText(isSeparate: true),

                TextColumn::make('brgy_name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->badge()
                    ->color('primary')
                    ->description(fn (Barangay $record) => $record->brgy_slug),

                TextColumn::make('currentCaptain.user.name')
                    ->label('Current Barangay Captain')
                    ->sortable()
                    ->searchable()
                    ->placeholder('No active captain'),

                IconColumn::make('is_published')
                    ->icon(fn (string $state): string => match ($state) {
                        '1' => 'phosphor-check-circle',
                        '0' => 'phosphor-x-circle',
                    })
                    ->label('Is Published?')
                    ->boolean(),

                IconColumn::make('is_featured')
                    ->icon(fn (string $state): string => match ($state) {
                        '1' => 'phosphor-check-circle',
                        '0' => 'phosphor-x-circle',
                    })
                    ->label('Is Featured?')
                    ->boolean(),

                TextColumn::make('brgy_desc')
                    ->label('Description')
                    ->wrap()
                    ->limit(50)
                    ->html()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                ->tooltip('Actions')
                ->icon('phosphor-dots-three-circle-vertical')
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
            ->emptyStateIcon('phosphor-buildings')
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
            'view' => Pages\ViewBarangay::route('/{record}'),
        ];
    }


    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewBarangay::class,
            EditBarangay::class,
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfoG::make([
                    InfoSec::make()
                    ->schema([

                        Split::make([
                            InfoG::make([
                                ImageEntry::make('brgy_logo')
                                ->hiddenlabel()
                                ->size(150)
                                ->square()
                                ->placeholder('No Image')
                                ->extraImgAttributes([
                                    'alt' => 'Logo',
                                    'loading' => 'lazy',
                                ]),

                                ImageEntry::make('brgy_img_gallery')
                                ->hiddenlabel()
                                ->height(50)
                                ->stacked()
                                ->square()
                                ->overlap(1)
                                ->limit(3)
                                ->limitedRemainingText()
                                ->extraImgAttributes([
                                    'loading' => 'lazy',
                                ])
                            ])
                            ->grow(false),

                            InfoG::make([
                                TextEntry::make('brgy_name')
                                ->label('')
                                ->color('primary')
                                ->size(TextEntry\TextEntrySize::Large)
                                ->weight(FontWeight::Bold)
                                ->formatStateUsing(fn (string $state): string => Str::title($state)),

                                TextEntry::make('brgy_slug')
                                ->label('Slug'),

                                InfoG::make([
                                    IconEntry::make('is_published')
                                    ->icon(fn (string $state): string => match ($state) {
                                        '1' => 'phosphor-check-circle',
                                        '0' => 'phosphor-x-circle',
                                    })
                                    ->label('Is Published?')
                                    ->boolean()
                                    ->color(fn (string $state): string => match ($state) {
                                        '1' => 'success',
                                        '0' => 'danger',
                                    })
                                    ->tooltip(fn (string $state): string => match ($state) {
                                        '1' => 'Yes',
                                        '0' => 'No',
                                    }),

                                    IconEntry::make('is_featured')
                                    ->icon(fn (string $state): string => match ($state) {
                                        '1' => 'phosphor-check-circle',
                                        '0' => 'phosphor-x-circle',
                                    })
                                    ->label('Is Featured?')
                                    ->boolean()
                                    ->color(fn (string $state): string => match ($state) {
                                        '1' => 'success',
                                        '0' => 'danger',
                                    })
                                    ->tooltip(fn (string $state): string => match ($state) {
                                        '1' => 'Yes',
                                        '0' => 'No',
                                    }),
                                ])
                                ->columns([
                                    'sm' => 1,
                                    'md' => 2,
                                    'lg' => 2,
                                ])
                            ])
                        ])
                        ->from('md')

                    ])
                    ->columnSpan(1),

                    InfoSec::make()
                    ->schema([
                        TextEntry::make('brgy_address')
                        ->label('Address')
                        ->icon('phosphor-map-pin-line')
                        ->formatStateUsing(fn (string $state): string => Str::title($state)),

                        TextEntry::make('brgy_contact')
                        ->label('Contact')
                        ->icon('phosphor-phone-call')
                        ->formatStateUsing(fn (string $state): string => Str::title($state)),

                        TextEntry::make('brgy_email')
                        ->label('Email')
                        ->icon('phosphor-envelope-simple'),


                    ])
                    ->columnSpan(1)

                ])
                ->columns([
                    'default' => 1,
                    'md' => 2,
                    'lg' => 2
                ])
                ->columnSpanFull(),

                InfoSec::make()
                ->schema([
                    TextEntry::make('brgy_desc')
                    ->label('')
                    ->markdown()
                ])
        ]);

    }
}
