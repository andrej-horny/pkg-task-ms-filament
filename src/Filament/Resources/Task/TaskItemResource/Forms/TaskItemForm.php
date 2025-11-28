<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskItemResource\Forms;

use Dpb\Package\Tasks\Repositories\TaskItemGroupRepositoryInterface;
use Filament\Forms;
use Filament\Forms\Form;

class TaskItemForm
{
    public static function make(Form $form): Form
    {
        return $form
            ->schema(static::schema())
            ->columns(6);
    }

    public static function schema(): array
    {
        return [
            // date
            Forms\Components\DatePicker::make('date')
                ->label(__('tms-ui::tasks/task-item.form.fields.date'))
                ->columnSpan(1)
                ->default(now()),
            // title
            Forms\Components\Select::make('group_id')
                ->label(__('tms-ui::tasks/task-item.form.fields.group'))
                ->options(
                    function (TaskItemGroupRepositoryInterface $tigRepo) {
                        return collect($tigRepo->all())->mapWithKeys(fn($tig) => [$tig->id() => $tig->title()]);
                    }
                )
                ->required()
                ->columnSpan(1),
            // title
            Forms\Components\TextInput::make('title')
                ->label(__('tms-ui::tasks/task-item.form.fields.title'))
                ->columnSpan(1),
            // description
            Forms\Components\Textarea::make('description')
                ->label(__('tms-ui::tasks/task-item.form.fields.description'))
                ->columnSpan(1)
        ];
    }
    /*
    public static function make1(Form $form): Form
    {
        return $form
            ->columns(7)
            ->schema([
                // // ticket
                // Forms\Components\Select::make('ticket_id')
                //     ->label(__('tasks/task-item.form.fields.ticket'))
                //     ->columnSpanFull()
                //     ->relationship('ticket', 'title', null, true)
                //     // ->getOptionLabelsUsing(fn(Task $record, TaskAssignment $ticketAssignment) => "{$record->id} - {$record->title}")
                //     ->preload()
                //     ->searchable()
                //     ->required()
                //     ->hiddenOn(TaskItemRelationManager::class),

                // date
                Forms\Components\DatePicker::make('date')
                    ->label(__('tasks/task-item.form.fields.date'))
                    ->columnSpan(1)
                    ->default(now()),
                // // subject
                // Forms\Components\Select::make('subject_id')
                //     ->label(__('tasks/task-item.form.fields.subject'))
                //     ->columnSpan(1)
                //     // ->relationship('source', 'title', null, true)
                //     ->options(fn() => Vehicle::pluck('code_1', 'id'))
                //     ->getOptionLabelsUsing(fn($record) => "{$record->code->code} - {$record->model->title}")
                //     ->preload()
                //     ->searchable()
                //     // ->disabled(fn($record) => $record->source_id == TaskSource::byCode('planned-maintenance')->first()->id)
                //     ->required(false)
                //     ->hiddenOn(TaskItemRelationManager::class),

                // title
                Forms\Components\Select::make('group_id')
                    ->relationship('group', 'title')
                    ->label(__('tasks/task-item.form.fields.title'))
                    ->columnSpan(2)
                    // ->options(fn() => ActivityTemplateGroup::has('parent')->pluck('title', 'id'))
                    ->getOptionLabelFromRecordUsing(fn(TaskItemGroup $record) => "{$record->code} {$record->title}")
                    ->searchable()
                    ->preload()
                    ->live(),

                // assigned to e.g. maintenance group
                Forms\Components\ToggleButtons::make('assigned_to')
                    ->label(__('tasks/task-item.form.fields.assigned_to'))
                    ->columnSpan(2)
                    ->options(fn() => MaintenanceGroup::pluck('code', 'id'))
                    ->default(function (RelationManager $livewire) {
                        return $livewire->getOwnerRecord()->assignedTo?->id;
                    })
                    ->inline(),

                // state
                Forms\Components\ToggleButtons::make('state')
                    ->label(__('tasks/task-item.form.fields.state'))
                    ->columnSpan(2)
                    ->options(fn() => [
                        Created::$name => __('tasks/task-item.states.created'),
                        InProgress::$name => __('tasks/task-item.states.in-progress'),
                        Closed::$name => __('tasks/task-item.states.closed'),
                    ])
                    ->inline(),

                // Forms\Components\TextInput::make('title')
                //     ->columnSpan(3)
                //     ->label(__('tasks/task-item.form.fields.title')),
                Forms\Components\Textarea::make('description')
                    ->label(__('tasks/task-item.form.fields.description'))
                    ->columnSpanFull(),

                // supervised by

                // activities 
                Forms\Components\Tabs::make('all_tabs')
                    ->columnSpan(4)
                    ->tabs([
                        // activities
                        Forms\Components\Tabs\Tab::make('activities')
                            ->label(__('tasks/task-item.form.tabs.activities'))
                            ->badge(fn($record) => $record->activities?->count() ?? 0)
                            ->icon('heroicon-m-wrench')
                            ->schema([
                                ActivityRepeater::make('activities')
                                    ->label(__('tasks/task-item.form.fields.activities.title'))
                                // ->relationship('activities'),
                            ]),
                        // materials
                        Forms\Components\Tabs\Tab::make('materials')
                            ->label(__('tasks/task-item.form.tabs.materials'))
                            ->icon('heroicon-m-rectangle-stack')
                            ->badge(fn($record) => $record->materials?->count() ?? 0)
                            ->schema([
                                MaterialRepeater::make('materials')
                                // ->relationship('materials'),
                            ]),
                        // services
                        Forms\Components\Tabs\Tab::make('services')
                            ->label(__('tasks/task-item.form.tabs.services'))
                            ->badge(0)
                            ->icon('heroicon-m-user-group')
                            ->schema([
                                ServiceRepeater::make('services')
                                // ->relationship('services'),
                            ])
                    ]),

                // history / comments
                Forms\Components\Tabs::make('comments_tabs')
                    ->columnSpan(3)
                    ->tabs([
                        // comments
                        Forms\Components\Tabs\Tab::make('comments_tab')
                            ->label(__('tasks/task-item.form.tabs.comments'))
                            ->badge(3)
                            ->icon('heroicon-m-wrench')
                            ->schema([
                                TableRepeater::make('comments')
                                    ->headers([
                                        Header::make('created_at')->label(__('tasks/task-item.form.fields.activities.date')),
                                        Header::make('author')->label(__('tasks/task-item.form.fields.activities.template')),
                                        Header::make('body')->label(__('tasks/task-item.form.fields.activities.template')),
                                    ])
                                    ->schema([
                                        Forms\Components\DateTimePicker::make('date1'),
                                        Forms\Components\RichEditor::make('body')
                                    ])
                                    ->deletable(false)
                                // ->addable(false)
                            ]),
                        // history
                        Forms\Components\Tabs\Tab::make('history_tab')
                            ->label(__('tasks/task-item.form.tabs.history'))
                            ->icon('heroicon-m-rectangle-stack')
                            ->badge(2)
                            ->schema([
                                TableRepeater::make('history')
                                    ->headers([
                                        Header::make('date')->label(__('tasks/task-item.form.fields.activities.date')),
                                        Header::make('template')->label(__('tasks/task-item.form.fields.activities.template')),
                                    ])
                                    ->schema([
                                        Forms\Components\DatePicker::make('date'),
                                        Forms\Components\TextInput::make('title')
                                    ])
                                    ->deletable(false)
                                    ->addable(false)
                            ]),
                    ]),
            ]);
    }
    */
}
