<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource\RelationManagers;

use Dpb\Package\TaskMS\Application\UseCase\Tasks\AddTaskItemUseCase;
use Dpb\Package\TaskMS\Application\UseCase\Tasks\UpdateTaskGroupUseCase;
use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskItemResource\Forms\TaskItemForm;
use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskItemResource\Tables\TaskItemTable;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class TaskItemRelationManager extends RelationManager
{
    protected static string $relationship = 'taskItems';

    public function form(Form $form): Form
    {
        return TaskItemForm::make($form);
    }

    public function table(Table $table): Table
    {
        return TaskItemTable::make($table)
            ->headerActions([
                CreateAction::make()
                    // ->mutateFormDataUsing(function (array $data) {
                    //     $data['assigned_to'] = 1;
                    //     return $data;
                    // })
                    ->action(function (array $data, AddTaskItemUseCase $addTaskItemUc) {                        
                        // dd($this->getOwnerRecord()->id, $data);        

                        $task = $addTaskItemUc->execute($this->getOwnerRecord()->id, $data);
                    })
                    ->modalWidth(MaxWidth::class),
            ]);
    }
}
