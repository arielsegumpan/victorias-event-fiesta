<?php

namespace App\Filament\Fiesta\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Fiesta;
use Filament\Forms\Set;
use App\Models\Barangay;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Fiesta\Resources\FiestaResource\Pages;
use App\Filament\Fiesta\Resources\FiestaResource\Pages\ViewFiesta;
use App\Filament\Fiesta\Resources\FiestaResource\RelationManagers;

class FiestaResource extends Resource
{
    protected static ?string $model = Fiesta::class;

    protected static ?string $navigationIcon = 'phosphor-confetti';

    protected static ?int $navigationSort = 0;

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

                        DatePicker::make('f_start_date')
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

                        DatePicker::make('f_end_date')
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
            ->emptyStateIcon('phosphor-confetti')
            ->emptyStateHeading('No fiestas are created')
            ->modifyQueryUsing(function (Builder $query) {
                $user = auth()->user();

                // Check if user has barangay captain role
                if ($user->hasAnyRole(['barangay captain', 'barangay_captain', 'brgy captain', 'brgy_captain', 'captain'])) {
                    // Get the barangay IDs where this user is a captain
                    $barangayIds = \App\Models\BarangayCaptain::where('user_id', $user->id)
                        ->pluck('barangay_id')
                        ->toArray();

                    // Filter fiestas to only show those from the captain's barangay(s)
                    return $query->whereIn('barangay_id', $barangayIds);
                }

                // Return unmodified query for other users (admins can see all)
                return $query;
            })
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
            'view' => ViewFiesta::route('/{record}'),
        ];
    }
}
