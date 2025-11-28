<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskItemResource\Tables;

use App\Filament\Resources\TS\TaskResource\RelationManagers\TaskItemRelationManager;
use App\Models\ActivityAssignment;
use App\Models\TaskAssignment;
use App\Models\TaskItemAssignment;
use App\Models\WorkAssignment;
use App\Services\Activity\Activity\WorkService;
use App\Services\TaskItemRepository;
use App\Services\TaskRepository;
use App\Services\TS\ActivityService;
use App\Services\TS\CreateTaskService;
use App\Services\TS\HeaderService;
use App\Services\TS\SubjectService;
use App\Services\TS\TaskAssignmentService;
use App\States;
use App\StateTransitions\TS\TaskItem\CreatedToInProgress;
use App\StateTransitions\TS\TaskItem\InProgressToCancelled;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Tasks\EloquentTaskItem;
use Dpb\Package\Tasks\Models\Task;
use Dpb\Package\Tasks\Models\TaskItem;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class TaskItemTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::tasks/task.relation_manager.task_items.table.heading'))
            ->emptyStateHeading(__('tms-ui::tasks/task.relation_manager.task_items.table.empty_state_heading'))
            ->emptyStateDescription(__('tms-ui::tasks/task.relation_manager.task_items.table.empty_state_description'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            // ->recordClasses(fn($record) => match ($record->state?->getValue()) {
            //     States\TS\Task\Created::$name => 'bg-blue-200',
            //     States\TS\Task\Closed::$name => 'bg-green-200',
            //     States\TS\Task\Cancelled::$name => 'bg-gray-50',
            //     States\TS\Task\InProgress::$name => 'bg-yellow-200',
            //     States\TS\TaskItem\AwaitingParts::$name => 'bg-red-200',
            //     default => null,
            // })
            // ->groups([
            //     Tables\Grouping\Group::make('author.name')
            //         ->collapsible(),
            // ])
            // ->defaultGroup('ticket_id')
            // ->defaultGroup(TaskItemRelationManager::class ? null : 'ticket_id')
            ->columns([
                // ticket id
                // Tables\Columns\TextColumn::make('ticket.id')
                //     ->label(__('tasks/task-item.table.columns.ticket.label'))
                //     ->tooltip(fn(TaskItem $record) => $record?->ticket?->title)
                //     ->badge(),
                // ticket item code id
                Tables\Columns\TextColumn::make('code')
                    ->label(__('tms-ui::tasks/task-item.table.columns.code'))
                    ->grow(false),
                Tables\Columns\TextColumn::make('date')->date()
                    ->label(__('tms-ui::tasks/task-item.table.columns.date'))
                    ->grow(false),
                // Tables\Columns\TextColumn::make('parent.id')
                //     ->label(__('tasks/task-item.table.columns.parent.label')),
                // title 
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tms-ui::tasks/task-item.table.columns.title')),

                Tables\Columns\TextColumn::make('group.title')
                    ->label(__('tms-ui::tasks/task-item.table.columns.group')),
                // Tables\Columns\TextColumn::make('title')
                //     ->label(__('tasks/task-item.table.columns.title.label')),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('tms-ui::tasks/task-item.table.columns.description'))
                    ->grow(),
                // Tables\Columns\TextColumn::make('state')
                //     ->label(__('tasks/task-item.table.columns.state.label'))
                //     ->state(fn(EloquentTaskItem $record) => $record?->state?->label()),
                // ->state(fn($record) => dd($record)),
                // ->action(
                //     Action::make('select')
                //         ->requiresConfirmation()
                //         ->action(function (TaskItem $record): void {
                //             $record->state == 'created'
                //                 ? $record->state->transition(new CreatedToInProgress($record, auth()->guard()->user()))
                //                 : $record->state->transition(new InProgressToCancelled($record, auth()->guard()->user()));
                //         }),
                // ),
                // // TextColumn::make('department.code'),
                // Tables\Columns\TextColumn::make('subject')
                //     ->label(__('tasks/task-item.table.columns.subject.label'))
                //     ->state(function (TaskItem $record, TaskAssignmentService $svc) {
                //         if ($record->ticket !== null) {
                //             return $svc->getSubject($record->ticket)?->code?->code;
                //         }
                //     })
                //     ->hiddenOn(TaskItemRelationManager::class),
                // Tables\Columns\TextColumn::make('source')
                //     ->label(__('tasks/task-item.table.columns.source.label'))
                //     ->state(function (TaskItem $record, TaskAssignmentService $svc) {
                //         if ($record->ticket !== null) {
                //             return $svc->getSourceLabel($record->ticket);
                //         }
                //     })
                //     ->hiddenOn(TaskItemRelationManager::class)
                //     ->badge(),
                // Tables\Columns\TextColumn::make('assigned_to')
                //     ->label(__('tasks/task-item.table.columns.assigned_to.label'))
                //     ->state(function (TaskItem $record, TaskItemAssignment $ticketItemAssignment) {
                //         return $ticketItemAssignment->whereBelongsTo($record, 'ticketItem')->first()?->assignedTo?->code;
                //     })
                //     ->badge()
                //     ->color(fn(string $state) => match ($state) {
                //         '1TPA' => '#888',
                //         default => '#333'
                //     }),
                // Tables\Columns\TextColumn::make('activities')
                //     ->label(__('tasks/task-item.table.columns.activities.label'))
                //     ->tooltip(__('tasks/task-item.table.columns.activities.tooltip'))
                //     ->state(function ($record, ActivityService $svc, WorkService $workService) {
                //         // $result = $svc->getActivities($record)?->map(function ($activity) use ($workService) {
                //         //     // dd($workService->getWorkIntervals($activity));
                //         //     return $activity->template->title
                //         //         . ' #' . $activity->template->duration
                //         //         . '/' . $workService->getWorkIntervals($activity)?->sum(function($work) {
                //         //             // return $work;
                //         //             return $work?->duration;
                //         //             // return print_r($work?->duration);
                //         //         });
                //         // });
                //         $activities = $svc->getActivities($record->ticket);
                //         $totalDuration = 0;
                //         foreach ($activities as $activity) {
                //             $totalDuration += $workService->getTotalDuration($activity);
                //         }
                //         $result = $svc->getTotalExpectedDuration($record->ticket) . ' min / ' . $totalDuration . ' min';
                //         return $result;
                //     }),
                // Tables\Columns\TextColumn::make('expenses')
                //     ->state(function ($record) {
                //         $result = $record->materials->sum(function ($material) {
                //             return $material->unit_price * $material->quantity;
                //         });
                //         return $result;
                //     }),

                // Tables\Columns\TextColumn::make('expenses')
                //     ->state(function ($record) {
                //         $materials = $record->materials->sum(function ($material) {
                //             return $material->price;
                //         });
                //         $services = $record->services->sum(function ($service) {
                //             return $service->price;
                //         });
                //         return $materials + $services;
                //     }),
                // Tables\Columns\TextColumn::make('man_minutes')
                //     ->state(function ($record) {
                //         $result = $record->activities->sum('duration');
                //         return $result;
                //     }),

            ])
            ->filters([
                //
            ])
            ->actions([
                // ViewAction::make(),
                // EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
