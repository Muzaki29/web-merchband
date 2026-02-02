<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class OrderForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Order Information')->schema([
                    TextInput::make('order_number')
                        ->disabled(),
                    TextInput::make('total_price')
                        ->prefix('Rp')
                        ->disabled(),
                    Select::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'paid' => 'Paid',
                            'shipped' => 'Shipped',
                            'cancelled' => 'Cancelled',
                            'expired' => 'Expired',
                        ])
                        ->required(),
                ])->columns(2),

                Section::make('Payment Details')->schema([
                    TextInput::make('payment_provider')
                         ->label('Provider')
                         ->disabled(),
                    TextInput::make('payment_ref')
                         ->label('Reference ID')
                         ->disabled(),
                ])->columns(2),
                
                Section::make('Customer Details')->schema([
                    TextInput::make('customer_name')->disabled(),
                    TextInput::make('customer_email')->disabled(),
                    TextInput::make('customer_phone')->disabled(),
                    Textarea::make('customer_address')->disabled()->columnSpanFull(),
                    TextInput::make('customer_city')->disabled(),
                    TextInput::make('customer_postal_code')->disabled(),
                ])->columns(3),

                Section::make('Order Items')->schema([
                    Repeater::make('items')
                        ->relationship()
                        ->schema([
                            TextInput::make('product_name')
                                ->label('Product')
                                ->disabled(),
                            TextInput::make('product_size')
                                ->label('Size')
                                ->disabled(),
                            TextInput::make('quantity')
                                ->disabled(),
                            TextInput::make('price')
                                ->prefix('Rp')
                                ->disabled(),
                        ])
                        ->columns(4)
                        ->addable(false)
                        ->deletable(false)
                        ->reorderable(false),
                ]),
            ]);
    }
}
