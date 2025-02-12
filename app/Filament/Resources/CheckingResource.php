<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CheckingResource\Pages;
use App\Filament\Resources\CheckingResource\Pages\CreateChecking;
use App\Filament\Resources\CheckingResource\RelationManagers;
use App\Models\Checking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CheckingResource extends Resource
{
    protected static ?string $model = Checking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 
                Forms\Components\Select::make('category_id')
                    ->required()
                    ->relationship('category', 'unit')
                    ->label('unit'),
                    Forms\Components\Select::make('category_id')
                    ->required()
                    ->relationship('category', 'no_Wo')
                    ->label('no_Wo'),
                    Forms\Components\TextInput::make('no_unit')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('note')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date_finding')
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.unit')
                ->description(fn (Checking $record): string => $record-> no_unit)
                ->label('unit'),
                Tables\Columns\TextColumn::make('category.no_Wo')
                    ->searchable()
                    ->label('no_Wo'),
                Tables\Columns\TextColumn::make('note')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_finding')
                    ->sortable()
                    ->label('tanggal'),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\IconColumn::make('status')
                ->label('Type Status')
                ->trueIcon('heroicon-o-arrow-up-circle')
                ->falseIcon('heroicon-o-arrow-down-circle')
                ->trueColor('danger')
                ->falseColor('success')
                ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListCheckings::route('/'),
            'create' => Pages\CreateChecking::route('/create'),
            'edit' => Pages\EditChecking::route('/{record}/edit'),
        ];
    }
}
