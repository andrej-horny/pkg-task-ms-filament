<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskGroupResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskGroupResource;
use Dpb\Package\TaskMS\Application\UseCase\Tasks\CreateTaskGroupUseCase;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Mappings\TaskGroupMapper;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CreateTaskGroup extends CreateRecord
{
    protected static string $resource = TaskGroupResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task-group.create_heading');
    }   

    protected function handleRecordCreation(array $data): Model    
    {       
        $taskGroup = app(CreateTaskGroupUseCase::class)->execute($data);
        return app(TaskGroupMapper::class)->toEloquent($taskGroup);
    }    
}
