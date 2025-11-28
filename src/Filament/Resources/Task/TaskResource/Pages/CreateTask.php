<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Tasks\CreateTaskUseCase;
use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Mappings\Tasks\TaskMapper;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task.create_heading');
    }   

    protected function handleRecordCreation(array $data): Model    
    {       
        $task = app(CreateTaskUseCase::class)->execute($data);
        return app(TaskMapper::class)->toEloquent($task);
    }    
}
