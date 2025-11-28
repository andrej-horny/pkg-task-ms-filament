<?php

namespace App\Filament\Resources\TS\TaskItemResource\Pages;

use App\Filament\Resources\TS\TaskItemResource;
use App\Services\TaskItemRepository;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateTaskItem extends CreateRecord
{
    protected static string $resource = TaskItemResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // dd($data);
        return app(TaskItemRepository::class)->create($data);
    }
}
