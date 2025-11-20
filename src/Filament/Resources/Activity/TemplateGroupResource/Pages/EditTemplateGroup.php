<?php

namespace App\Filament\Resources\Activity\TemplateGroupResource\Pages;

use App\Filament\Resources\Activity\TemplateGroupResource;
use Dpb\Package\TaskMS\Application\UseCase\Activities\UpdateActivityTemplateGroupUesCase;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;

class EditTemplateGroup extends EditRecord
{
    protected static string $resource = TemplateGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return __('tms-ui::activities/activity-template-group.update_heading');
    }  

    protected function handleRecordUpdate(Model $record, array $data): Model    
    {       
        $templateGroup = app(UpdateActivityTemplateGroupUesCase::class)->execute($record->id, $data);
        return $record;
    }          
}
