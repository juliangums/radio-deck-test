<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers;
use App\Models\Bank;
use App\Models\Item;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use JaOcero\RadioDeck\Forms\Components\RadioDeck;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                RadioDeck::make('bank_id')
                    ->label('Bank')
                    ->options(
                        Item::all()
                            ->reduce(function ($carry, $item) {
                                $carry[$item->id] = $item->name;
                                return $carry;
                            }, [])
                    )
                    ->icons(
                        Item::all()
                            ->reduce(function ($carry, $item) {
                                $carry[$item->id] = $item->icon;
                                return $carry;
                            }, [])
                    )
                    ->descriptions(
                        Item::all()
                            ->reduce(function ($carry, $item) {
                                $carry[$item->id] = $item->descriptions;
                                return $carry;
                            }, [])
                    )
                    ->required()
                    ->iconPosition(IconPosition::Before) // Before | After | (string - before | after)
                    ->gap('gap-5') // Gap between Icon and Description (Any TailwindCSS gap-* utility)
                    ->padding('px-4 px-6') // Padding around the deck (Any TailwindCSS padding utility)
                    ->direction('column') // Column | Row (Allows to place the Icon on top)
                    ->columns(3)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
