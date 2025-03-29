<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductViewResource\Pages;
use App\Filament\Resources\ProductViewResource\RelationManagers;
use App\Models\ProductView;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductViewResource extends Resource
{
    protected static ?string $model = ProductView::class;

    protected static ?string $navigationIcon = 'heroicon-o-eye';

    protected static ?string $navigationGroup = 'Analytics';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('ip_address')
                    ->required()
                    ->maxLength(45),
                Forms\Components\TextInput::make('user_agent')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('viewed_at')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ip_address')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user_agent')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('viewed_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('product')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\Filter::make('viewed_at')
                    ->form([
                        Forms\Components\DateTimePicker::make('viewed_from'),
                        Forms\Components\DateTimePicker::make('viewed_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['viewed_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('viewed_at', '>=', $date),
                            )
                            ->when(
                                $data['viewed_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('viewed_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('viewed_at', 'desc');
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
            'index' => Pages\ListProductViews::route('/'),
        ];
    }
}
