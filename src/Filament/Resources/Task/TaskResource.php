<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task;

use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource\Pages;
use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource\Tables\TaskTable;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Tasks\EloquentTask;
use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource\Forms\TaskForm;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class TaskResource extends Resource
{
    protected static ?string $model = EloquentTask::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::tasks/task.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::tasks/task.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::tasks/task.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::tasks/task.navigation.group');
    }

    public static function getNavigationSort(): ?int
    {
        return config('pkg-tasks.navigation.task') ?? 999;
    }

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->can('tasks.task.read');
    // }
    public static function form(Form $form): Form
    {
        return TaskForm::make($form);
    }

    public static function table(Table $table): Table
    {
        return TaskTable::make($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
