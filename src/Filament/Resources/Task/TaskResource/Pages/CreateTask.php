<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Tasks\CreateTaskUesCase;
use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Mappings\TaskMapper;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;

    protected function handleRecordCreation(array $data): Model    
    {       
        $task = app(CreateTaskUesCase::class)->execute($data);
        return app(TaskMapper::class)->toEloquent($task);
    }    
}
