<?php

namespace App\Filament\Admin\Resources\FiestaResource\Pages;

use Filament\Forms;
use Filament\Tables;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Admin\Resources\FiestaResource;
use Filament\Resources\Pages\ManageRelatedRecords;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\TextEntry\TextEntrySize;

class ManageFiestaComments extends ManageRelatedRecords
{
    protected static string $resource = FiestaResource::class;

    protected static string $relationship = 'comments';

    protected static ?string $navigationIcon = 'phosphor-chat-teardrop-text';

    protected static string $badgeColor = 'success';

    public function getTitle(): string | Htmlable
    {
        $recordTitle = $this->getRecordTitle();

        $recordTitle = $recordTitle instanceof Htmlable ? $recordTitle->toHtml() : $recordTitle;

        return "Manage {$recordTitle} Comments";
    }

    public static function getNavigationLabel(): string
    {
        return 'Manage Comments';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('f_name')
                    ->required()
                    ->maxLength(255),
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
                    ->sortable(),

                Tables\Columns\TextColumn::make('comment')
                    ->label('comment')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('comment_imgs')
                    ->label('Attahchments')
                    ->stacked()
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DissociateAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            ->emptyStateHeading('No comments are created');
    }


    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(2)
            ->schema([
                TextEntry::make('fiesta.f_name')->columnSpanFull()->size(TextEntrySize::Large)->color('primary')
                ->label('Title'),
                TextEntry::make('user.name')
                ->badge()->color('success')
                ->label('Commented user'),
                IconEntry::make('is_approved')
                    ->label('Is approved?')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextEntry::make('comment')
                    ->label('Comment :')
                    ->markdown()->columnSpanFull(),
                ImageEntry::make('comment_imgs')
                    ->stacked()
            ]);
    }
}
