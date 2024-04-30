<?php

namespace App\Filament\Resources\ShopsResource\Pages;

use App\Filament\Resources\ShopsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Concerns\ExposesTableToWidgets;

class ListShops extends ListRecords
{

    use ExposesTableToWidgets;
    protected static string $resource = ShopsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

}
