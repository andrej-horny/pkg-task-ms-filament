<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource\Tables;

use App\Models\TaskAssignment;
use App\Services\Activity\Activity\WorkService;
use App\Services\TaskAssignmentRepository;
use App\Services\TS\ActivityService;
use App\Services\TS\CreateTaskService;
use App\Services\TS\HeaderService;
use App\Services\TS\SubjectService;
use App\States;
use App\StateTransitions\TS\CreatedToInProgress;
use App\StateTransitions\TS\InProgressToCancelled;
use Dpb\Package\Tasks\Models\Task;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class TaskTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->heading(__('tms-ui::tasks/task.table.heading'))
            ->emptyStateHeading(__('tms-ui::tasks/task.table.empty_state_heading'))
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            // ->recordClasses(fn($record) => match ($record->state?->getValue()) {
            //     States\TS\Task\Created::$name => 'bg-blue-200',
            //     States\TS\Task\Closed::$name => 'bg-green-200',
            //     States\TS\Task\Cancelled::$name => 'bg-gray-50',
            //     States\TS\Task\InProgress::$name => 'bg-yellow-200',
            //     default => null,
            // })
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('tms-ui::tasks/task.table.columns.id')),
                // date
                Tables\Columns\TextColumn::make('date')->date()
                    ->label(__('tms-ui::tasks/task.table.columns.date')),
                // subject
                Tables\Columns\TextColumn::make('subjectLabel')
                    ->label(__('tms-ui::tasks/task.table.columns.subject')),
                // Tables\Columns\TextColumn::make('title')
                //     ->label(__('tms-ui::tasks/task.table.columns.title.label')),
                // task group
                Tables\Columns\TextColumn::make('group.title')
                    ->label(__('tms-ui::tasks/task.table.columns.group')),
                // description
                Tables\Columns\TextColumn::make('description')
                    ->label(__('tms-ui::tasks/task.table.columns.description'))
                    ->grow(),
                // Tables\Columns\TextColumn::make('state')
                //     ->label(__('tms-ui::tasks/task.table.columns.state'))
                //     ->state(fn(Task $record) => $record->state->label())
                //     // ->state(fn($record) => dd($record)),
                //     ->action(
                //         Action::make('select')
                //             ->requiresConfirmation()
                //             ->action(function (Task $record): void {
                //                 $record->state == 'created'
                //                     ? $record->state->transition(new CreatedToInProgress($record, auth()->guard()->user()))
                //                     : $record->state->transition(new InProgressToCancelled($record, auth()->guard()->user()));
                //             }),
                //     ),
                // TextColumn::make('department.code'),
                // Tables\Columns\TextColumn::make('department')
                //     ->label(__('tms-ui::tasks/task.table.columns.department.label'))
                //     ->state(function (HeaderService $svc, $record) {
                //         return $svc->getHeader($record)?->department?->code;
                //     }),
                // Tables\Columns\TextColumn::make('activities')
                //     ->label(__('tms-ui::tasks/task.table.columns.activities.label'))
                //     ->tooltip(__('tms-ui::tasks/task.table.columns.activities.tooltip'))
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
                //         $activities = $svc->getActivities($record);
                //         $totalDuration = 0;
                //         foreach ($activities as $activity) {
                //             $totalDuration += $workService->getTotalDuration($activity);
                //         }
                //         $result = $svc->getTotalExpectedDuration($record) . ' min / ' . $totalDuration . ' min';
                //         return $result;
                //     }),
                // assigned to 
                Tables\Columns\TextColumn::make('assignedToLabel')
                    ->label(__('tms-ui::tasks/task.table.columns.assigned_to')),
                // Tables\Columns\TextColumn::make('expenses')
                //     ->state(function ($record) {
                //         $result = $record->materials->sum(function ($material) {
                //             return $material->unit_price * $material->quantity;
                //         });
                //         return $result;
                //     }),
                // place of occurrence
                Tables\Columns\TextColumn::make('placeOfOccurrence.title')
                    ->label(__('tms-ui::tasks/task.table.columns.place_of_occurrence')),
                // expenses
                Tables\Columns\TextColumn::make('expenses')
                    ->label(__('tms-ui::tasks/task.table.columns.total_expenses'))
                // ->state(function ($record) {
                // $total = 0;
                // if ($record->has('materials')) {
                //     $total += $record->materials->sum(function ($material) {
                //         return $material->price;
                //     });
                // }
                // if ($record->has('services')) {
                //     $services = $record->services->sum(function ($service) {
                //         return $service->price;
                //     });
                // }
                // return $total;
                // }),
                // Tables\Columns\TextColumn::make('man_minutes')
                //     ->state(function ($record) {
                //         $result = $record->activities->sum('duration');
                //         return $result;
                //     }),
            ])
            // ->filters(TaskTableFilters::make())
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                // ->mutateRecordDataUsing(function (
                //     $record,
                //     array $data,
                //     SubjectService $subjectSvc,
                //     HeaderService $headerSvc,
                //     ActivityService $activitySvc
                // ): array {
                //     $data['subject_id'] = $subjectSvc->getSubject($record)?->id;
                //     $data['department_id'] = $headerSvc->getHeader($record)?->department?->id;
                //     $data['source_id'] = $record?->source?->id;
                //     // $activities = $activitySvc->getActivities($record);
                //     // foreach ($activities as $activity) {
                //     //     $data['activities'][] = [
                //     //             'id' => $activity->id,
                //     //             'date' => $activity->date,
                //     //             // 'activity_template_id' => $activity->template_id
                //     //     ];
                //     // }
                //     // $data['activities'] = $activitySvc->getActivities($record)
                //     //     ->map(function($activity) {
                //     //         return [
                //     //             'date' => $activity->date,
                //     //             'activity_template_id' => $activity->template_id
                //     //         ];
                //     //     });
                //     $data['activities'] = $activitySvc->getActivities($record);
                //     return $data;
                // })
                // ->using(function (Model $record, array $data, CreateTaskService $ticketSvc): ?Model {
                //     return $ticketSvc->update($record, $data);
                // })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
