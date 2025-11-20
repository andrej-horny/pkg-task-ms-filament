<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task;

use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource\Pages;
use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource\RelationManagers;
use Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource\Tables\TaskTable;
use App\Models\Task\Task;
use Dpb\Package\Fleet\Models\MaintenanceGroup;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Fleet\EloquentMaintenanceGroup;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\EloquentTask;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

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
        return $form
            ->schema([
                DatePicker::make('date')->default(Carbon::now()),
                TextInput::make('title'),
                TextInput::make('description'),
                Select::make('group')
                    ->relationship('group', 'title')
                    ->searchable()
                    ->preload(),

                Forms\Components\ToggleButtons::make('maintenanceGroup')
                    ->label(__('tickets/ticket.form.fields.assigned_to'))
                    ->columnSpan(2)
                    ->options(
                        fn() =>
                        EloquentMaintenanceGroup::pluck('code', 'id')
                    )
                    ->inline(),
            ]);
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
