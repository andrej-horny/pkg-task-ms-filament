<?php

namespace TmsUI\Filament\Resources\Activity\ActivityTemplateResource\Pages;

use App\Models\ActivityTemplateAssignment;
use Dpb\Package\TaskMS\Application\UseCase\Activities\UpdateActivityTemplateUesCase;
use TmsUI\Filament\Resources\Activity\ActivityTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditActivityTemplate extends EditRecord
{
    protected static string $resource = ActivityTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::activities/activity-template.update_heading');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $subjectId = ActivityTemplateAssignment::whereBelongsTo($this->record, 'template')->first()?->subject?->id;

        $data['subject_id'] = $subjectId;
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model    
    {       
        $template = app(UpdateActivityTemplateUesCase::class)->execute($record->id, $data);
        return $record;
    }       
}
