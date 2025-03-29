<?php

namespace App\Filament\Resources\MenuResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Route;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'allItems';

    protected static ?string $title = 'Menu Items';

    protected static ?string $modelLabel = 'Menu Item';

    public function form(Form $form): Form
    {
        $routes = collect(Route::getRoutes())->map(function ($route) {
            return $route->getName();
        })->filter()->sort()->all();

        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Select::make('parent_id')
                            ->label('Menu cha')
                            ->relationship('parent', 'title')
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('title')
                            ->label('Tiêu đề')
                            ->required(),
                        Forms\Components\TextInput::make('url')
                            ->label('URL')
                            ->helperText('Nhập URL tùy chỉnh hoặc chọn route bên dưới'),
                        Forms\Components\Select::make('route')
                            ->label('Route')
                            ->options(array_combine($routes, $routes))
                            ->searchable()
                            ->helperText('Chọn route có sẵn trong hệ thống'),
                        Forms\Components\TextInput::make('icon')
                            ->label('Icon')
                            ->helperText('Ví dụ: fas fa-home'),
                        Forms\Components\Select::make('target')
                            ->label('Target')
                            ->options([
                                '_self' => 'Cửa sổ hiện tại',
                                '_blank' => 'Cửa sổ mới',
                            ])
                            ->default('_self'),
                        Forms\Components\TextInput::make('order')
                            ->label('Thứ tự')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Kích hoạt')
                            ->default(true),
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('parent.title')
                    ->label('Menu cha'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Tiêu đề')
                    ->searchable(),
                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('route')
                    ->label('Route')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('order')
                    ->label('Thứ tự')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Kích hoạt')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('order')
            ->defaultSort('order');
    }
}
