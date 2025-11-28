<?php

namespace App\Filament\Resources\TS\TaskItemResource\Pages;

use App\Filament\Resources\TS\TaskItemResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTaskItems extends ListRecords
{
    protected static string $resource = TaskItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
