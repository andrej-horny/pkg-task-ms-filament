<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Tasks\UpdateTaskUesCase;
use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditTask extends EditRecord
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // maintenance group / assigned to
        $data['maintenanceGroup'] = $this->record->assigned_to_id;
        // dd($activities);
        return $data;
    }


    protected function handleRecordUpdate(Model $record, array $data): Model    
    {       
        $task = app(updatetaskuescase::class)->execute($record->id, $data);
        return $record;
    }       
}
