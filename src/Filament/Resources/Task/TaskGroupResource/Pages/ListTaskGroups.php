<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskGroupResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;

class ListTaskGroups extends ListRecords
{
    protected static string $resource = TaskGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }   

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task-group.list_heading');
    }       
}
