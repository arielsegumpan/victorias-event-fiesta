<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Fiesta;
use Filament\Forms\Set;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Split;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\DateTimePicker;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Group as InfoG;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Section as InfoSec;
use App\Filament\Admin\Resources\FiestaResource\Pages;
use App\Filament\Admin\Resources\FiestaResource\Pages\EditFiesta;
use App\Filament\Admin\Resources\FiestaResource\Pages\ViewFiesta;
use App\Filament\Admin\Resources\FiestaResource\RelationManagers;

class FiestaResource extends Resource
{
    protected static ?string $model = Fiesta::class;

    protected static ?string $navigationIcon = 'phosphor-confetti';

    protected static ?int $navigationSort = 0;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make()
                ->schema([
                    Group::make([
                        Select::make('barangay_id')
                        ->label('Barangay')
                        ->relationship(name: 'barangay', titleAttribute:'brgy_name')
                        ->required()
                        ->native(false)
                        ->searchable()
                        ->preload()
                        ->optionsLimit(6),

                        Select::make('created_by')
                        ->label('Created By')
                        ->relationship(name: 'user', titleAttribute:'name')
                        ->required()
                        ->native(false)
                        ->searchable()
                        ->preload()
                        ->optionsLimit(6),

                        Select::make('category_id')
                        ->label('Category')
                        ->relationship(name: 'category', titleAttribute:'cat_name')
                        ->required()
                        ->native(false)
                        ->searchable()
                        ->preload()
                        ->optionsLimit(6)
                        ->createOptionForm([
                            Group::make([
                                Section::make()
                                ->schema([
                                    TextInput::make('cat_name')
                                    ->label('Name')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Category::class, 'cat_slug', ignoreRecord: true)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('cat_slug', Str::slug($state))),

                                    TextInput::make('cat_slug')
                                    ->label('Slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Category::class, 'cat_slug', ignoreRecord: true),

                                    Textarea::make('cat_description')
                                    ->label('Description')
                                    ->maxLength(65535)
                                    ->columnSpanFull()
                                    ->rows(6)
                                ])
                                ->columnSpan([
                                    'sm' => 1,
                                    'md' => 3,
                                    'lg' => 3,
                                ]),

                                Section::make()
                                ->schema([
                                    FileUpload::make('cat_image')
                                    ->hiddenlabel()
                                    ->image()
                                    ->imageEditor()
                                    ->maxSize('2048')
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
                            ]),
                        ])
                        ->columnSpanFull()
                        ->getOptionLabelFromRecordUsing(fn (Model $record) => Str::title($record->cat_name))

                    ])
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 2,
                    ]),

                    TextInput::make('f_name')
                    ->label('Fiesta Name')
                    ->required()
                    ->maxLength(255)
                    ->unique(Fiesta::class, 'f_slug', ignoreRecord: true)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('f_slug', Str::slug($state))),

                    TextInput::make('f_slug')
                    ->label('Fiesta Name')
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->maxLength(255)
                    ->unique(Fiesta::class, 'f_slug', ignoreRecord: true),

                    RichEditor::make('f_description')
                    ->label('Description')
                    ->required()
                    ->disableToolbarButtons([
                        'codeBlock',
                    ])
                    ->maxLength(65535),

                    TagsInput::make('tags')
                    ->label('Tags')
                    ->prefixIcon('phosphor-tag')
                    ->reorderable()
                    ->splitKeys(['Tab', ' '])
                    ->nestedRecursiveRules([
                        'min:3',
                        'max:255',
                    ])
                    ->columnSpanFull()

                ])
                ->columnSpan([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 3,
                ]),

                Group::make([
                    Section::make()
                    ->schema([

                        DateTimePicker::make('f_start_date')
                        ->label('Start Date')
                        ->seconds(false)
                        ->required()
                        ->displayFormat('F j, Y, g:i A')
                        ->native(false)
                        ->closeOnDateSelection()
                        ->prefix('Starts')
                        ->maxDate(now()->addYear())
                        ->minDate(now())
                        ->columnSpanFull()
                        ->timezone(config('app.timezone'))
                        ->suffixIcon('phosphor-calendar-dot'),

                        DateTimePicker::make('f_end_date')
                        ->label('End Date')
                        ->native(false)
                        ->seconds(false)
                        ->displayFormat('F j, Y, g:i A')
                        ->maxDate(now()->addYear())
                        ->closeOnDateSelection()
                        ->prefix('Ends')
                        ->minDate(now())
                        ->columnSpanFull()
                        ->timezone(config('app.timezone'))
                        ->suffixIcon('phosphor-calendar-dots'),

                        ToggleButtons::make('is_featured')
                        ->label('Is Featured?')
                        ->inline()
                        ->boolean()
                        ->options([
                            '1' => 'Yes',
                            '0' => 'No',
                        ])
                        ->dehydrated()
                        ->default('0'),

                        ToggleButtons::make('is_published')
                        ->label('Is Published?')
                        ->inline()
                        ->boolean()
                        ->options([
                            '1' => 'Yes',
                            '0' => 'No',
                        ])
                        ->dehydrated()
                        ->default('0')
                    ])
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 2,
                    ]),

                    Section::make('Images')
                    ->schema([
                        FileUpload::make('f_images')
                        ->hiddenlabel()
                        ->multiple()
                        ->image()
                        ->imageEditor()
                        ->required()
                        ->imageEditorAspectRatios([
                            '16:9',
                            '4:3',
                            '1:1',
                        ])
                        ->reorderable()
                        ->appendFiles()
                        ->maxFiles(5)
                        ->maxSize(2048),
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
                'md' => 4,
                'lg' => 5,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('f_name')
                ->label('Fiesta Name')
                ->searchable()
                ->sortable()
                ->size(TextColumn\TextColumnSize::Large)
                ->description(fn (Fiesta $record) => $record->f_slug),

                TextColumn::make('barangay.brgy_name')
                ->label('Barangay')
                ->searchable()
                ->sortable(),

                TextColumn::make('category.cat_name')
                ->label('Category')
                ->searchable()
                ->sortable()
                ->badge()
                ->color('primary'),

                TextColumn::make('f_start_date')
                ->label('Start Date')
                ->date('F j, Y')
                ->sortable(),

                TextColumn::make('f_end_date')
                ->label('End Date')
                ->date('F j, Y')
                ->sortable(),


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
                ->label(__('New Fiesta')),
            ])
            ->emptyStateIcon('heroicon-o-sparkles')
            ->emptyStateHeading('No fiestas are created')
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
            'index' => Pages\ListFiestas::route('/'),
            'create' => Pages\CreateFiesta::route('/create'),
            'edit' => Pages\EditFiesta::route('/{record}/edit'),
            'view' => Pages\ViewFiesta::route('/{record}'),
        ];
    }


    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewFiesta::class,
            EditFiesta::class,
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([

                InfoSec::make()
                ->schema([
                    Split::make([
                        ImageEntry::make('f_images')
                        ->hiddenlabel()
                        ->height(130)
                        ->stacked()
                        ->circular()
                        ->overlap(8)
                        ->limit(3)
                        ->limitedRemainingText()
                        ->extraImgAttributes([
                            'loading' => 'lazy',
                        ])
                        ->grow(false),

                        InfoG::make([
                            TextEntry::make('f_name')
                            ->label('')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->weight('bold'),

                            TextEntry::make('f_slug')
                            ->label(''),

                            InfoG::make([
                                TextEntry::make('barangay.brgy_name')
                                ->label('Barangay')
                                ->icon('phosphor-buildings')
                                ->size(TextEntry\TextEntrySize::Large),

                                TextEntry::make('category.cat_name')
                                ->label('Category')
                                ->icon('phosphor-tag')
                                ->badge()
                                ->color('primary'),
                            ])
                            ->columns([
                                'sm' => 1,
                                'md' => 2,
                                'lg' => 2,
                            ]),
                        ])
                    ])
                    ->from('md')
                    ->columnSpanFull(),
                ])
                ->columnSpanFull(),

                InfoSec::make()
                ->schema([
                    InfoG::make([

                        IconEntry::make('is_featured')
                        ->icon(fn (Fiesta $record): string => $record->is_featured ?
                        'phosphor-check-circle' :
                        'phosphor-x-circle'
                        )
                        ->color(fn (Fiesta $record): string => $record->is_featured ?
                        'success' :
                        'danger'
                        )
                        ->label('Is Featured?'),

                        IconEntry::make('is_published')
                        ->icon(fn (Fiesta $record): string => $record->is_published ?
                        'phosphor-check-circle' :
                        'phosphor-x-circle'
                        )
                        ->color(fn (Fiesta $record): string => $record->is_published ?
                        'success' :
                        'danger'
                        )
                        ->label('Is Published?'),

                        TextEntry::make('f_start_date')
                        ->label('Start Date')
                        ->icon('phosphor-calendar-dot')
                        ->date('F j, Y, g:i a'),

                        TextEntry::make('f_end_date')
                        ->label('End Date')
                        ->icon('phosphor-calendar-dots')
                        ->date('F j, Y, g:i a'),

                    ])
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 4,
                    ])
                ]),


                InfoSec::make()
                ->schema([
                    TextEntry::make('f_description')
                    ->label('')
                    ->markdown()
                ])


            ]);
    }
}
