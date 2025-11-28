<?php

namespace App\Filament\Resources\TS\TaskItemResource\Pages;

use App\Filament\Resources\TS\TaskItemResource;
use App\Models\ActivityAssignment;
use App\Models\TaskAssignment;
use App\Models\TaskItemAssignment;
use App\Services\TaskAssignmentRepository;
use App\Services\TaskItemRepository;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditTaskItem extends EditRecord
{
    protected static string $resource = TaskItemResource::class;
    
    public function getTitle(): string | Htmlable
    {
        $subjectCode = null;
        // $subjectCode = app(TaskAssignment::class)->whereBelongsTo($this->record->ticket, 'ticket')->first()->subject->code->code;
        return __('tasks/task-item.form.update_heading', ['code' => $subjectCode]);
    }  

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // $subjectId = TaskAssignment::whereBelongsTo($this->record->ticket)->first()?->subject?->id;
        // $data['subject_id'] = $subjectId;

        $activities = ActivityAssignment::whereMorphedTo('subject', $this->record->ticketItem)
            ->with(['activity', 'activity.template'])
            ->get()
            ->map(fn($assignment) => $assignment->activity);
        $data['activities'] = $activities;

        // assigned to
        // $assignedToId = TaskItemAssignment::whereBelongsTo($this->record, 'ticketItem')->first()?->assignedTo?->id;
        // $data['assigned_to'] = $assignedToId;

        // dd($data);
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $ticketItemRepo = app(TaskItemRepository::class);
        $result = $ticketItemRepo->update($record, $data);

        return $result;
    }
}
