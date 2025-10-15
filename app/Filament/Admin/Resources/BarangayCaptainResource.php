<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Set;
use App\Models\Barangay;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\BarangayCaptain;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\BarangayCaptainResource\Pages;
use App\Filament\Admin\Resources\BarangayCaptainResource\RelationManagers;

class BarangayCaptainResource extends Resource
{
    protected static ?string $model = BarangayCaptain::class;

    protected static ?string $navigationIcon = 'phosphor-users-four';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                   Select::make('barangay_id')
                        ->relationship(
                            name: 'barangay',
                            titleAttribute: 'brgy_name',
                            modifyQueryUsing: function ($query, $operation, $record) {
                                // Get IDs of barangays already assigned to other captains
                                $assignedBarangayIds = \App\Models\BarangayCaptain::query()
                                    ->when($operation === 'edit' && $record, function ($q) use ($record) {
                                        // Exclude current record when editing
                                        $q->where('id', '!=', $record->id);
                                    })
                                    ->pluck('barangay_id')
                                    ->toArray();

                                // Only show barangays that are not assigned
                                return $query->whereNotIn('id', $assignedBarangayIds);
                            }
                        )
                        ->native(false)
                        ->required()
                        ->preload()
                        ->optionsLimit(6)
                        ->searchable()
                        ->createOptionForm([
                            Group::make([
                                Section::make()
                                ->schema([
                                    Group::make([
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
                                    ])
                                    ->columns([
                                        'default' => 1,
                                        'md' => 2,
                                        'lg' => 2
                                    ]),

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
                                            '1' => 'heroicon-o-check-circle',
                                            '0' => 'heroicon-o-x-circle',
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
                                ])
                                ->columnSpan([
                                    'sm' => 1,
                                    'md' => 3,
                                    'lg' => 3,
                                ]),

                                Group::make([
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
                                'default' => 1,
                                'md' => 5,
                                'lg' => 5
                            ])
                    ]),

                    Select::make('user_id')
                    ->label('Kapitan')
                    ->relationship(
                        name: 'user',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn ($query) => $query->whereHas('roles', function ($q) {
                            $q->whereIn('name', [
                                'barangay captain',
                                'barangay_captain',
                                'brgy captain',
                                'brgy_captain',
                                'captain'
                            ]);
                        })
                    )
                    ->native(false)
                    ->required()
                    ->preload()
                    ->searchable(),

                    DatePicker::make('term_start')
                    ->prefixIcon('phosphor-calendar-dots')
                    ->native(false)
                    ->timezone('Asia/Manila')
                    ->closeOnDateSelection(),

                    DatePicker::make('term_end')
                    ->prefixIcon('phosphor-calendar-dots')
                    ->native(false)
                    ->timezone('Asia/Manila')
                    ->closeOnDateSelection(),
                ])
                ->columns([
                    'default' => 1,
                    'md' => 2,
                    'lg' => 2
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                ->label('Kapitan')
                ->searchable()
                ->sortable()
                ->toggleable()
                ->badge()
                ->color('primary')
                ->description(fn (BarangayCaptain $record) => $record->user->email),

                TextColumn::make('barangay.brgy_name')
                ->label('Barangay')
                ->searchable()
                ->sortable()
                ->toggleable()
                ->badge()
                ->color('primary'),

                TextColumn::make('term_start')
                ->label('Term Start')
                ->date('F j, Y')
                ->sortable()
                ->badge()
                ->color('success'),

                TextColumn::make('term_end')
                ->label('Term End')
                ->date('F j, Y')
                ->sortable()
                ->badge()
                ->color('danger'),
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
                ->icon('heroicon-m-user-group')
                ->label(__('New Barangay Captain')),
            ])
            ->emptyStateIcon('heroicon-o-user-group')
            ->emptyStateHeading('No barangay captains are created')
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
            'index' => Pages\ListBarangayCaptains::route('/'),
            'create' => Pages\CreateBarangayCaptain::route('/create'),
            'edit' => Pages\EditBarangayCaptain::route('/{record}/edit'),
        ];
    }
}
