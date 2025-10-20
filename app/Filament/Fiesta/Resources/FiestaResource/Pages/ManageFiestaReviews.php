<?php

namespace App\Filament\Fiesta\Resources\FiestaResource\Pages;

use Filament\Forms;
use Filament\Tables;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;
use Mokhosh\FilamentRating\Components\Rating;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use App\Filament\Fiesta\Resources\FiestaResource;
use Filament\Resources\Pages\ManageRelatedRecords;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ManageFiestaReviews extends ManageRelatedRecords
{
    protected static string $resource = FiestaResource::class;

    protected static string $relationship = 'reviews';

    protected static ?string $navigationIcon = 'phosphor-sparkle';

    protected static string $badgeColor = 'success';

    public function getTitle(): string | Htmlable
    {
        $recordTitle = $this->getRecordTitle();

        $recordTitle = $recordTitle instanceof Htmlable ? $recordTitle->toHtml() : $recordTitle;

        return "Manage {$recordTitle} Reviews";
    }

    public static function getNavigationLabel(): string
    {
        return 'Manage Reviews';
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make([

                    Rating::make('rating')
                    ->stars(5)
                    ->color('primary')
                    ->size('md')
                    ->columnSpanFull(),

                    Select::make('user_id')
                    ->label('Victoriasanon')
                    ->relationship(
                        name: 'user',
                        titleAttribute: 'name',
                        modifyQueryUsing: function (Builder $query) {
                            return $query->whereHas('roles', function ($q) {
                                $q->where('name', 'victoriasanon');
                            });
                        }
                    )
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->optionsLimit(6),

                    Select::make('fiesta_id')
                    ->label('Fiesta')
                    ->relationship(name: 'fiesta', titleAttribute:'f_name')
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->optionsLimit(6),



                    Textarea::make('review')
                    ->label('Comment')
                    ->required()
                    ->maxLength(2048)
                    ->rows(6)
                    ->columnSpanFull(),
                ])
                ->columnSpan([
                    'default' => 1,
                    'md' => 3,
                    'lg' => 3
                ]),

                FileUpload::make('review_images')
                ->label('Attachments')
                ->multiple()
                ->minFiles(1)
                ->maxFiles(5)
                ->image()
                ->imageEditor()
                ->maxSize(2048)
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                ->columnSpan([
                    'default' => 1,
                    'md' => 2,
                    'lg' => 2
                ])
            ])
            ->columns([
                'default' => 1,
                'md' => 5,
                'lg' => 5
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('fiesta_id')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Victoriasanon')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('fiesta.f_name')
                    ->label('Fiesta Name')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->wrap(),

                    RatingColumn::make('rating')
                    ->color('primary')
                    ->size('sm'),

                Tables\Columns\TextColumn::make('review')
                    ->label('comment')
                    ->searchable()
                    ->sortable()
                    ->limit(80)
                    ->wrap(),

                Tables\Columns\ImageColumn::make('review_images')
                    ->label('Attahchments')
                    ->stacked(5)
                    ->circular(),


            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AssociateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DissociateAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                ->icon('phosphor-dots-three-circle-vertical')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DissociateBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->deferLoading()
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                ->icon('phosphor-plus')
                ->label(__('New comment')),
            ])
            ->emptyStateIcon('phosphor-chat-teardrop-text')
            ->emptyStateHeading('No reviews are created');
    }
}
