<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Contact;
use Filament\Forms\Form;
use App\Mail\ContactReply;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\ContactResource\Pages;
use App\Filament\Admin\Resources\ContactResource\RelationManagers;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'phosphor-address-book';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    TextInput::make('name')
                    ->maxlength(255)
                    ->required(),

                    TextInput::make('email')
                    ->email()
                    ->maxlength(255)
                    ->required(),

                    TextInput::make('phone')
                    ->tel()
                    ->required(),

                    Textarea::make('message')
                    ->required()
                    ->rows(6)
                    ->columnSpanFull(),

                    ToggleButtons::make('is_replied')
                    ->label('Is already replied?')
                    ->boolean()
                    ->default(false)
                    ->inline()
                    ->dehydrated(),
                ])
                ->columns([
                    'default' => 3,
                    'sm' => 3,
                    'md' => 3
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->sortable()
                ->searchable(),

                TextColumn::make('email')
                ->sortable()
                ->searchable()
                ->badge()
                ->color('warning')
                ->icon('phosphor-envelope')
                ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('phone')
                ->sortable()
                ->searchable()
                ->badge()
                ->color('success')
                ->icon('phosphor-phone-call')
                ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('message')
                ->wrap()
                ->limit(80),

                IconColumn::make('is_replied')
                ->boolean(),

                TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),


            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('reply')
                    ->label('Reply')
                    ->icon('phosphor-paper-plane-tilt')
                    ->color('primary')
                    ->button()
                    ->form([
                        TextInput::make('subject')
                            ->label('Reply Subject')
                            ->required()
                            ->disabled()
                            ->default(fn (Contact $record) => 'Re: ' . ucwords($record->subject)),

                        RichEditor::make('reply_message')
                            ->label('Reply Message')
                            ->required()
                            ->maxLength(65535),
                    ])
                    ->action(function (Contact $record, array $data): void {
                        try {
                            // Send Markdown email
                            Mail::to($record->email)
                                ->send(new ContactReply(
                                    $record->email,
                                    $record->message,
                                    $data['reply_message']
                                ));
                            // Update inquiry status
                            $record->update([
                                'user_id' => auth()->user()->id,
                                'is_replied' => 1,
                                'replied_at' => now(),
                            ]);

                            // Show success notification
                            Notification::make()
                            ->success()
                            ->title('Reply Sent')
                            ->body('Your reply has been sent successfully.')
                            ->send();

                        } catch (\Exception $e) {
                            // Handle email sending error
                            Notification::make()
                                ->error()
                                ->title('Reply Failed')
                                ->body('Could not send reply: ' . $e->getMessage())
                                ->send();
                        }
                    })
                    ->modalWidth('xl'),
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
                ->icon('phosphor-plus')
                ->label(__('New Contact')),
            ])
            ->emptyStateIcon('phosphor-address-book')
            ->emptyStateHeading('No Contacts are created')
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
