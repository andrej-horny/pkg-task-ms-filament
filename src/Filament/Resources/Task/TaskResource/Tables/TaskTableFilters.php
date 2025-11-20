<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource\Tables;

use Dpb\Package\TaskMSFilament\Filament\Components\VehiclePicker;
use Dpb\Package\Fleet\Models\MaintenanceGroup;
use Dpb\Package\Fleet\Models\Vehicle;
use Dpb\Package\tasks\Models\taskSource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\ToggleButtons;
use App\States;

class TaskTableFilters
{
    public static function make(): array
    {
        return [
            // date
            Tables\Filters\Filter::make('date')
                ->form([
                    DatePicker::make('date')
                        ->label(__('tms-ui::tasks/task.table.filters.date')),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['date'],
                            fn(Builder $query, $date): Builder =>
                            $query->whereHas('task', function ($q) use ($date) {
                                $q->whereDate('date', '=', $date);
                            })
                        );
                }),

            // task state
            // Tables\Filters\Filter::make('state')
            //     ->form([
            //         ToggleButtons::make('state')
            //             ->options([
            //                 States\TS\taskItem\Created::$name => __('tms-ui::tasks/task.states.created'),
            //                 States\TS\taskItem\Closed::$name => __('tms-ui::tasks/task.states.closed'),
            //                 States\TS\taskItem\Cancelled::$name => __('tms-ui::tasks/task.states.cancelled'),
            //                 States\TS\taskItem\InProgress::$name => __('tms-ui::tasks/task.states.in-progress'),
            //                 States\TS\taskItem\AwaitingParts::$name => __('tms-ui::tasks/task-item.states.awaiting-parts'),
            //             ])
            //             ->multiple()
            //             ->inline()
            //             ->label(__('tms-ui::tasks/task.table.filters.state')),
            //     ])
            //     ->query(function (Builder $query, array $data): Builder {
            //         return $query
            //             ->when(
            //                 $data['state'],
            //                 fn(Builder $query, $state): Builder =>
            //                 $query->whereHas('task', function ($q) use ($state) {
            //                     $q->whereIn('state', $state);
            //                 })
            //             );
            //     }),
            // subject
            Tables\Filters\Filter::make('subject')
                ->form([
                    VehiclePicker::make('subject')
                        ->options(
                            Vehicle::query()
                                ->has('codes')
                                ->with(['codes' => fn($q) => $q->orderByDesc('date_from'), 'model'])
                                ->get()
                                ->mapWithKeys(function (Vehicle $vehicle) {
                                    $latestCode = $vehicle->codes->first();
                                    if (!$latestCode) {
                                        return []; // important: return empty array if no code
                                    }
                                    return [
                                        $vehicle->id => $latestCode->code,
                                    ];
                                })
                                ->toArray()
                        )
                        ->getSearchResultsUsing(null)
                        ->getOptionLabelFromRecordUsing(null)
                        ->searchable()
                        ->multiple()
                        ->label(__('tms-ui::tasks/task.table.filters.subject')),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['subject'],
                            fn(Builder $query, $subject): Builder =>
                            $query->whereMorphedTo(
                                'subject',
                                app(Vehicle::class)->getMorphClass(),
                            )
                                ->whereIn('subject_id', $subject)
                        );
                }),
            // source
            Tables\Filters\SelectFilter::make('task_source_id')
                ->relationship('task.source', 'title')
                ->searchable()
                ->preload()
                ->multiple()
                ->label(__('tms-ui::tasks/task.table.filters.source')),
            // maintenance group
            Tables\Filters\Filter::make('assignedTo')
                ->form([
                    ToggleButtons::make('assignedTo')
                        ->options(MaintenanceGroup::pluck('code', 'id'))
                        ->multiple()
                        ->inline()
                        ->label(__('tms-ui::tasks/task.table.filters.assigned_to')),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['assignedTo'],
                            fn(Builder $query, $assignedTo): Builder =>
                            $query->whereMorphedTo(
                                'assignedTo',
                                app(MaintenanceGroup::class)->getMorphClass(),
                            )
                                ->whereIn('assigned_to_id', $assignedTo)
                        );
                }),
        ];
    }
}
