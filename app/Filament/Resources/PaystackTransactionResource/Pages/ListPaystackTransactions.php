<?php

namespace App\Filament\Resources\PaystackTransactionResource\Pages;

use App\Filament\Resources\PaystackTransactionResource;
use Filament\Resources\Pages\ListRecords;

class ListPaystackTransactions extends ListRecords
{
    protected static string $resource = PaystackTransactionResource::class;
}
