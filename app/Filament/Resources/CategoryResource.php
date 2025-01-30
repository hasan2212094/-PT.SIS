<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-c-bars-3-center-left';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('unit')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_WO')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date_category')
                    ->required(),
                Forms\Components\TextInput::make('model')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('qty')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'open' => 'Open',
                    'on_proses' => 'On_proses',
                    'done' => 'Done',
                    'hold'=>'Hold'
                ])
                ->default('open')
                ->required(),
                Forms\Components\TextInput::make('persentasi')
                ->required()
                ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('unit')
                ->searchable(),
            Tables\Columns\TextColumn::make('no_WO')
                ->searchable(),
            Tables\Columns\TextColumn::make('date_category')
                ->sortable(),
            Tables\Columns\TextColumn::make('model')
                ->searchable(),
            Tables\Columns\TextColumn::make('qty')
                ->searchable(),
            Tables\Columns\IconColumn::make('status')
            ->icon(fn (string $state): string => match ($state) {
                'open' => 'heroicon-o-pencil',
                'on_proses' => 'heroicon-o-clock',
                'done' => 'heroicon-o-check-circle',
                'hold'=>'heroicon-c-x-circle' })
                ->color(fn (string $state): string => match ($state) {
                    'open' => 'info',
                    'on_proses' => 'warning',
                    'done' => 'success',
                    'hold'=>'danger', }),
            Tables\Columns\TextColumn::make('persentasi')
               ->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
