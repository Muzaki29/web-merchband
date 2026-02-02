<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Product Details')->schema([
                    TextInput::make('name')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                    TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true),
                    RichEditor::make('description')
                        ->columnSpanFull(),
                    TextInput::make('price')
                        ->numeric()
                        ->prefix('Rp')
                        ->required(),
                    Toggle::make('is_active')
                        ->default(true),
                    FileUpload::make('image')
                        ->image()
                        ->directory('products')
                        ->visibility('public'),
                ])->columns(2),
                
                Section::make('Variants')->schema([
                    Repeater::make('variants')
                        ->relationship()
                        ->schema([
                            Select::make('size')
                                ->options([
                                    'S' => 'S',
                                    'M' => 'M',
                                    'L' => 'L',
                                    'XL' => 'XL',
                                    'XXL' => 'XXL',
                                ])
                                ->required(),
                            TextInput::make('sku')
                                ->label('SKU')
                                ->unique(ignoreRecord: true)
                                ->required(),
                            TextInput::make('stock')
                                ->numeric()
                                ->minValue(0)
                                ->default(0)
                                ->required(),
                            TextInput::make('price')
                                ->numeric()
                                ->prefix('Rp')
                                ->label('Price (Optional)')
                                ->nullable(),
                        ])
                        ->columns(3)
                        ->grid(1)
                        ->itemLabel(fn (array $state): ?string => $state['size'] ?? null),
                ]),
            ]);
    }
}
