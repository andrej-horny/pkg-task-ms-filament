<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource\Pages;

use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Tasks\EloquentTaskGroup;
use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource;
use Dpb\Package\Tasks\Entities\TaskGroup;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class ListTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return '';
    }    

    public function getTabs(): array
    {
        $tabs = [];

        // Default “all” tab
        $tabs['all'] = Tab::make('Všetky');

        // Dynamic tabs
        foreach (EloquentTaskGroup::get() as $taskGroup) {
            $tabs[$taskGroup->uri] = Tab::make($taskGroup->title)
                ->modifyQueryUsing(
                    function (Builder $query) use ($taskGroup) {
                        $query->whereHas('group', function ($q) use ($taskGroup) {
                            $q->ByUri($taskGroup->uri);
                        });
                    }
                );
        }

        return $tabs;
    }    
}
