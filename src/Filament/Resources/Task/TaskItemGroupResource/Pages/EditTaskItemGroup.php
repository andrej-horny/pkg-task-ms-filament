<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskItemGroupResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskItemGroupResource;
use Dpb\Package\TaskMS\Application\UseCase\Tasks\UpdateTaskItemGroupUseCase;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditTaskItemGroup extends EditRecord
{
    protected static string $resource = TaskItemGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task-item-group.update_heading', ['title' => $this->record->title]);
    }    

    protected function handleRecordUpdate(Model $record, array $data): Model    
    {       
        $taskGroup = app(UpdateTaskItemGroupUseCase::class)->execute($record->id, $data);
        return $record;
    }       
}
