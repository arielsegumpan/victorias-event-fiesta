<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Get;
use App\Models\Barangay;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Resources\Pages\Page;
use Spatie\Permission\Models\Role;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\SubNavigationPosition;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckboxList;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\UserResource\Pages;
use Filament\Infolists\Components\Section as InfoSec;
use App\Filament\Admin\Resources\UserResource\Pages\EditUser;
use App\Filament\Admin\Resources\UserResource\Pages\ViewUser;
use App\Filament\Admin\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'phosphor-users';

    protected static ?string $navigationGroup = 'Roles & Permissions';

    protected static ?string $modelLabel = 'Victoriasanon';
    protected static ?string $pluralModelLabel = 'Victoriasanons';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([

                    Group::make([
                        Section::make('Victoriasanon Details')
                        ->description('The user\'s name and email address.')
                        ->schema([

                            Group::make([
                                TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan([
                                    'sm' => 1,
                                    'md' => 1,
                                    'lg' => 1
                                ]),

                                TextInput::make('email')
                                ->required()
                                ->email()
                                ->unique(ignoreRecord: true)
                                ->columnSpan([
                                    'sm' => 1,
                                    'md' => 1,
                                    'lg' => 1
                                ]),
                            ])
                            ->columns([
                                'sm' => 1,
                                'md' => 2,
                                'lg' => 2
                            ]),

                            TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                            ->required(fn (Page $livewire): bool => $livewire instanceof Pages\EditUser)
                            ->visible(fn (Page $livewire): bool => $livewire instanceof Pages\CreateUser),

                            TextInput::make('password_confirmation')
                            ->label('Confirm Password')
                            ->password()
                            ->revealable()
                            ->required(fn (Page $livewire): bool => $livewire instanceof Pages\EditUser)
                            ->visible(fn (Page $livewire): bool => $livewire instanceof Pages\CreateUser),
                        ])
                        ->columns(1),

                        Section::make('Barangay Captain Assignment')
                        ->description('Assign this user to a barangay as captain')
                        ->schema([
                            Select::make('barangay_id')
                            ->label('Barangay')
                            ->relationship(name: 'currentBarangay', titleAttribute: 'brgy_name')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->barangay->brgy_name ?? 'N/A')
                            ->searchable()
                            ->preload()
                            ->optionsLimit(10)
                            ->native(false)
                            ->options(function () {
                                return Barangay::all()->pluck('brgy_name', 'id');
                            })
                            ->required()
                            ->afterStateHydrated(function (Select $component, $state, $record) {
                                if ($record && $record->currentBarangay) {
                                    $component->state($record->currentBarangay->barangay_id);
                                }
                            }),

                            DatePicker::make('term_start')
                            ->label('Term Start Date')
                            ->required()
                            ->minDate(now()->subDays(1))
                            ->default(now())
                            ->native(false)
                            ->afterStateHydrated(function (DatePicker $component, $state, $record) {
                                if ($record && $record->currentBarangay) {
                                    $component->state($record->currentBarangay->term_start);
                                }
                            }),

                            DatePicker::make('term_end')
                            ->label('Term End Date')
                            ->nullable()
                            ->after('term_start')
                            ->minDate(now()->subDays(1))
                            ->native(false)
                            ->afterStateHydrated(function (DatePicker $component, $state, $record) {
                                if ($record && $record->currentBarangay) {
                                    $component->state($record->currentBarangay->term_end);
                                }
                            }),
                        ])
                        ->columns(3)
                        ->visible(function (Get $get) {
                            $selectedRoles = $get('roles');

                            if (empty($selectedRoles)) {
                                return false;
                            }

                            // Get the role names for selected role IDs
                            $roleNames = Role::whereIn('id', $selectedRoles)->pluck('name')->toArray();

                            // Check if any captain role is selected
                            $captainRoles = ['barangay captain', 'barangay_captain', 'brgy captain', 'brgy_captain', 'captain'];

                            return !empty(array_intersect($captainRoles, $roleNames));
                        })
                        ->columnSpanFull(),
                    ]),


                    Section::make('Roles')
                    ->description('Select roles for this user')
                    ->schema([
                        CheckboxList::make('roles')
                        ->label('Select Roles')
                        ->relationship(name: 'roles', titleAttribute: 'name')
                        ->searchable()
                        ->columns(2)
                        ->live(debounce: 500)
                        ->options(function () {
                            return Role::all()->mapWithKeys(function ($role) {
                                return [$role->id => Str::replace('_', ' ', Str::ucwords($role->name))];
                            });
                        })
                    ])->columnSpanFull(),

                ])
                ->from('md')
                ->columns([
                    'sm' => 1,
                    'md' => 2,
                ])
                ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('name')
            ->searchable()
            ->sortable(),
            TextColumn::make('email')
            ->searchable()
            ->sortable(),

            TextColumn::make('roles.name')
            ->formatStateUsing(fn ($state): string => ucwords(str_replace('_', ' ', $state)))
            ->searchable()
            ->sortable()
            ->badge()
            ->color('warning')
            ->description(fn (User $record) => $record->captainOf->first()->barangay->brgy_name ?? 'N/A'),

            TextColumn::make('created_at')
            ->date()
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


                // BulkAction::make('assign_role')
                // ->icon('heroicon-o-shield-check')
                // ->color('primary')
                // ->label('Assign Role')
                // ->form([
                //     Forms\Components\Select::make('role')
                //         ->label('Role')
                //         ->options(
                //             Role::all()->mapWithKeys(function ($role) {
                //                 $formattedName = str_replace('_', ' ', $role->name);
                //                 $formattedName = ucwords($formattedName);
                //                 return [$role->id => $formattedName];
                //             })
                //         )
                //         ->native(false)
                //         ->required()
                //         ->searchable()
                //         ->preload()
                //         ->optionsLimit(6),


                //     Forms\Components\Select::make('volunteer_role')
                //     ->label('Volunteer Role')
                //     ->required()
                //     ->options([
                //         'dog_walking' => 'Dog Walking',
                //         'event_assistance' => 'Event Assistance',
                //         'admin_support' => 'Admin Support',
                //         'community_outreach' => 'Community Outreach',
                //     ])->native(false),




                // ])
                // ->action(function (array $data, $records) {
                //     // Find the selected role
                //     $role = Role::findById($data['role']);

                //     // Assign role to selected users
                //     foreach ($records as $record) {
                //         // Remove existing roles and assign new role
                //         $record->syncRoles([$role]);


                //         Volunteer::updateOrCreate(
                //             ['user_id' => $record->id], // Unique identifier for lookup
                //             [
                //                 'volunteer_role' => $data['volunteer_role'],
                //                 'volunteer_reason' => 'I love dogs',
                //                 'volunteer_status_type' => 'approved',
                //                 'volunteer_status' => 'active',
                //                 'volunteer_joined_date' => now(),
                //             ]);
                //     }

                //     // Notification::make()
                //     //     ->success()
                //     //     ->title('Roles Assigned')
                //     //     ->body("Role '{$role->name}' assigned to selected users.")
                //     //     ->send();
                // })
                // ->deselectRecordsAfterCompletion()
            ]),
        ])
        ->deferLoading()
        ->emptyStateActions([
            Tables\Actions\CreateAction::make()
            ->icon('heroicon-m-plus')
            ->label(__('Create User')),
        ])
        ->emptyStateIcon('heroicon-o-users')
        ->emptyStateHeading('No users are created');
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }


    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            ViewUser::class,
            EditUser::class,
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfoSec::make()
                ->schema([
                    TextEntry::make('name')
                    ->weight('bold'),

                    TextEntry::make('email')
                    ->icon('phosphor-envelope-simple'),

                    TextEntry::make('roles.name')
                    ->formatStateUsing(fn ($state) => Str::title($state))
                    ->badge()
                    ->color('warning')
                    ->icon('phosphor-user-circle-check')
                    ->columnSpanFull(),
                ])
                ->columns([
                    'default' => 1,
                    'sm' => 2,
                    'md' => 2,
                    'lg' => 2
                ])
                ->columnSpan([
                    'default' => 1,
                    'sm' => 3,
                    'md' => 3,
                    'lg' => 3
                ]),

                InfoSec::make()
                ->schema([
                    TextEntry::make('currentBarangay.barangay.brgy_name')
                    ->label('Barangay Captain of')
                    ->weight('bold')
                    ->icon('phosphor-buildings')
                    ->columnSpanFull(),

                    TextEntry::make('currentBarangay.barangay.currentCaptain.term_start')
                    ->label('Term Start')
                    ->date()
                    ->badge()
                    ->color('success')
                    ->icon('phosphor-calendar-dot'),

                    TextEntry::make('currentBarangay.barangay.currentCaptain.term_end')
                    ->label('Term Start')
                    ->date()
                    ->badge()
                    ->color('danger')
                    ->icon('phosphor-calendar-dots'),

                ])
                ->columns([
                    'default' => 1,
                    'sm' => 2,
                    'md' => 2,
                ])
                ->columnSpan([
                    'default' => 1,
                    'sm' => 2,
                    'md' => 2,
                    'lg' => 2
                ]),
            ])
            ->columns([
                'default' => 1,
                'sm' => 5,
                'md' => 5,
                'lg' => 5
            ]);
    }
}
