<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Communication';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required(),
                        Forms\Components\TextInput::make('phone')
                            ->tel(),
                        Forms\Components\TextInput::make('company'),
                        Forms\Components\TextInput::make('subject')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('message')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('source')
                            ->options([
                                'website' => 'Website',
                                'email' => 'Email',
                                'phone' => 'Phone',
                                'other' => 'Other',
                            ])
                            ->default('website'),
                        Forms\Components\Select::make('status')
                            ->options([
                                'new' => 'New',
                                'in_progress' => 'In Progress',
                                'replied' => 'Replied',
                                'spam' => 'Spam',
                                'archived' => 'Archived',
                            ])
                            ->default('new'),
                        Forms\Components\DateTimePicker::make('read_at')
                            ->label('Read At')
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('replied_at')
                            ->label('Replied At')
                            ->disabled(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('source')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'info',
                        'in_progress' => 'warning',
                        'replied' => 'success',
                        'spam' => 'danger',
                        'archived' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('read_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('replied_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('source')
                    ->options([
                        'website' => 'Website',
                        'email' => 'Email',
                        'phone' => 'Phone',
                        'other' => 'Other',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'in_progress' => 'In Progress',
                        'replied' => 'Replied',
                        'spam' => 'Spam',
                        'archived' => 'Archived',
                    ]),
                Tables\Filters\Filter::make('unread')
                    ->query(fn (Builder $query): Builder => $query->whereNull('read_at')),
                Tables\Filters\Filter::make('read')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('read_at')),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('mark_as_read')
                        ->icon('heroicon-m-eye')
                        ->requiresConfirmation()
                        ->action(fn (Contact $record) => $record->markAsRead()),
                    Tables\Actions\Action::make('mark_as_replied')
                        ->icon('heroicon-m-arrow-uturn-left')
                        ->requiresConfirmation()
                        ->action(fn (Contact $record) => $record->markAsReplied()),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
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
