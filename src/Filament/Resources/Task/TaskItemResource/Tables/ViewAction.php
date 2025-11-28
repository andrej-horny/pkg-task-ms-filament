<?php

namespace App\Filament\Resources\TS\TaskItemResource\Tables;

use App\Filament\Resources\TS\TaskResource\RelationManagers\TaskItemRelationManager;
use App\Models\ActivityAssignment;
use App\Models\TaskAssignment;
use App\Models\TaskItemAssignment;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\ViewAction as ActionsViewAction;

class ViewAction
{
    public static function make(): ActionsViewAction
    {
        return ActionsViewAction::make()
            ->modalWidth(MaxWidth::class)
            ->mutateRecordDataUsing(function (
                $record,
                array $data,
                TaskAssignment $ticketAssignment,
                TaskItemAssignment $ticketItemAssignment,
                ActivityAssignment $activityAssignment
            ): array {
                // subject
                $subjectId = $ticketAssignment->whereBelongsTo($record->ticket)->first()?->subject?->id;
                $data['subject_id'] = $subjectId;

                // activities
                $activities = $activityAssignment->whereMorphedTo('subject', $record)
                    ->with(['activity', 'activity.template'])
                    ->get()
                    ->map(fn($assignment) => $assignment->activity);
                $data['activities'] = $activities;
                // dd($activities);

                // assigned to
                $assignedToId = $ticketItemAssignment->whereBelongsTo($record, 'ticketItem')->first()?->assignedTo?->id;
                $data['assigned_to'] = $assignedToId;

                return $data;
            });
    }
}
