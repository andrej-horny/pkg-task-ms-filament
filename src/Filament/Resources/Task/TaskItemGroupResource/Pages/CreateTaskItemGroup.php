<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskItemGroupResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Tasks\CreateTaskItemGroupUseCase;
use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskItemGroupResource;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Mappings\Tasks\TaskItemGroupMapper;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CreateTaskItemGroup extends CreateRecord
{
    protected static string $resource = TaskItemGroupResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task-item-group.create_heading');
    }   

    protected function handleRecordCreation(array $data): Model    
    {       
        $taskItemGroup = app(CreateTaskItemGroupUseCase::class)->execute($data);
        return app(TaskItemGroupMapper::class)->toEloquent($taskItemGroup);
    }    
}
