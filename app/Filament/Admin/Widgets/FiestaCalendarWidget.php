<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Fiesta;
use Filament\Forms\Set;
use App\Models\Barangay;
use App\Models\Category;
use Illuminate\Support\Str;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Guava\Calendar\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Guava\Calendar\Widgets\CalendarWidget;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\DateTimePicker;
use Guava\Calendar\ValueObjects\CalendarEvent;
use App\Filament\Admin\Resources\FiestaResource;
use Guava\Calendar\ValueObjects\CalendarResource;

class FiestaCalendarWidget extends CalendarWidget
{
    // protected static string $view = 'filament.admin.widgets.fiesta-calendar-widget';

    protected bool $eventClickEnabled = true;

    protected bool $eventResizeEnabled = true;

    protected ?string $defaultEventClickAction = 'edit';


    public function getEvents(array $fetchInfo = []): Collection | array
    {
        return Fiesta::get();
    }


    public function getOptions(): array
    {
        return [
            'nowIndicator' => true,
            'slotDuration' => '00:15:00'
        ];
    }


    public function getSchema(?string $model = null): ?array
    {
        return match($model) {
            Fiesta::class => [

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
                        ->getOptionLabelFromRecordUsing(fn (Model $record) => Str::title($record->cat_name))
                        ->columnSpanFull()

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
                        ->maxDate(now())
                        ->columnSpanFull()
                        ->timezone(config('app.timezone')),

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
                        ->timezone(config('app.timezone')),

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
            ],
        };
    }


    // public function getEventClickContextMenuActions(): array
    // {
    //     return [
    //         $this->viewAction(),
    //         $this->editAction(),
    //         $this->deleteAction(),
    //     ];
    // }

}
