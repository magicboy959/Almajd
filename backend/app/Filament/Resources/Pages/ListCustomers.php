<?php
namespace App\Filament\Resources\Pages;
use App\Filament\Resources\CustomerResource;
use Filament\Resources\Pages\ListRecords;
class ListCustomers extends ListRecords { protected static string $resource=CustomerResource::class; }
