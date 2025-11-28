<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource\Pages;

use Dpb\Package\TaskMS\Application\UseCase\Tasks\UpdateTaskUseCase;
use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
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

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::tasks/task.update_heading', ['title' => $this->record->id]);
    }    

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // maintenance group / assigned to
        $data['assigned_to_id'] = $this->record->assigned_to_id;
        //
        $data['subject_id'] = $this->record->subject_id;
        // dd($activities);
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model    
    {       
        $task = app(UpdateTaskUseCase::class)->execute($record->id, $data);
        return $record;
    }       
}
