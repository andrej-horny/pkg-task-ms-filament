<?php

namespace App\Filament\Resources\TS\TaskItemResource\Pages;

use App\Filament\Resources\TS\TaskItemResource;
use App\Models\ActivityAssignment;
use App\Models\TaskAssignment;
use App\Models\TaskHeader;
use App\Models\TaskSubject;
use App\Services\Activity\Activity\WorkService;
use App\Services\TS\ActivityService;
use App\Services\TS\HeaderService;
use App\Services\TS\MaterialService;
use App\Services\TS\ServiceService;
use App\Services\TS\SubjectService;
use Dpb\Package\Tasks\Models\Task;
use Dpb\Package\Tasks\Models\TaskItem;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Model;

class ViewTaskItemPage extends Page
{
    protected static string $resource = TaskItemResource::class;

    protected static string $view = 'filament.resources.ts.ticket-item-resource.pages.view-ticket-item-page';

    public TaskItem $ticketItem;
    public ?TaskAssignment $ticketAssignment;
    // public $activities;
    public $totalExpectedDuration;
    public $totalDuration;
    public $totalMaterialExpenses;
    public $totalServiceExpenses;
    public $materials;
    public $services;
    public $workIntervals;
    public $workAssignments;

    // public function __construct(private TaskItem $ticketItemRepo) 
    // {
    // }

    public function getHeading(): string
    {
        return 'Podzákzka: ' . $this->ticketItem->id . ' - ' . $this->ticketItem->title;
    }

    public function mount(
        TaskItem $ticketItemRepo,
        TaskAssignment $ticketAssignmentRepo,
        ActivityAssignment $activityAssignmentRepo,
        int $record
    ): void {
        // $this->ticketItem = TaskItem::findOrFail($record)->first();
        // $this->ticketItem = TaskItem::findOrFail($record);
        $this->ticketItem = $ticketItemRepo->findOrFail($record);

        // $this->ticketAssignment = app(HeaderService::class)->getHeader($this->ticket);
        $this->ticketAssignment = $ticketAssignmentRepo->whereBelongsTo($this->ticketItem->ticket, 'ticket')->first();

        // $activitySvc = app(ActivityService::class);
        // $this->activities = $activitySvc->getActivities($this->ticketItem);
        // $this->totalExpectedDuration = $activitySvc->getTotalExpectedDuration($this->ticketItem);
        // $this->activities = $activityAssignmentRepo->whereMorphedTo('subject', $this->ticketItem)
        //     ->with(['activity', 'activity.template'])
        //     ->get()
        //     ->map(fn($assignment) => $assignment->activity);

        // // expense materials
        // $materialsSvc = app(MaterialService::class);
        // $this->materials = $materialsSvc->getMaterials($this->ticketItem);
        // $this->totalMaterialExpenses = $materialsSvc->getTotalMaterialExpenses($this->ticketItem);

        // // expense service
        // $servicesSvc = app(ServiceService::class);
        // $this->services = $servicesSvc->getServices($this->ticketItem);
        // $this->totalServiceExpenses = $servicesSvc->getTotalServiceExpenses($this->ticketItem);

    }
}
