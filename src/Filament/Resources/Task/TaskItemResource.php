<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class TaskItemResource extends Resource
{
    // protected static ?string $model = Elotaite::class;

    public static function getModelLabel(): string
    {
        return __('tasks/task-item.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tasks/task-item.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tasks/task-item.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tasks/task-item.navigation.group');
    }

    public static function getNavigationSort(): ?int
    {
        return config('pkg-tickets.navigation.ticket-item') ?? 999;
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can('tickets.ticket-item.read');
    }

    public static function form(Form $form): Form
    {
        return TaskItemForm::make($form);
    }

    public static function table(Table $table): Table
    {
        return TaskItemTable::make($table);
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
            'index' => Pages\ListTaskItems::route('/'),
            'create' => Pages\CreateTaskItem::route('/create'),
            'view' => Pages\ViewTaskItemPage::route('/{record}'),
            'edit' => Pages\EditTaskItem::route('/{record}/edit'),
        ];
    }
}
