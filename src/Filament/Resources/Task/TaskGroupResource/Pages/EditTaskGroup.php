<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskGroupResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskGroupResource;
use Dpb\Package\TaskMS\Application\UseCase\Tasks\UpdateTaskGroupUesCase;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditTaskGroup extends EditRecord
{
    protected static string $resource = TaskGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task-group.update_heading', ['title' => $this->record->title]);
    }    

    protected function handleRecordUpdate(Model $record, array $data): Model    
    {       
        $taskGroup = app(UpdateTaskGroupUesCase::class)->execute($record->id, $data);
        return $record;
    }       
}
