<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\TaskResource\Forms;

use Dpb\Package\TaskMSFilament\Filament\Components\DepartmentPicker;
// use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\Vehicle\VehicleResource\Forms\VehiclePicker;
// use Dpb\Package\TaskMSFilament\Filament\Resources\TS\TicketResource\Components\ActivityRepeater;
// use Dpb\Package\TaskMSFilament\Filament\Resources\TS\TicketResource\Components\MaterialRepeater;
// use Dpb\Package\TaskMSFilament\Filament\Resources\TS\TicketResource\Components\ServiceRepeater;
use App\Services\Activity\Activity\WorkService;
use App\Services\TS\ActivityService;
use App\Services\TS\HeaderService;
use App\Services\TS\SubjectService;
use Dpb\Package\Fleet\Models\Vehicle;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Fleet\EloquentMaintenanceGroup;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Fleet\EloquentVehicle;
use Dpb\Package\Tickets\Models\Ticket;
use Dpb\Package\Tickets\Models\TicketSource;
use Filament\Forms;
use Filament\Forms\Form;

class TaskForm
{
    public static function make(Form $form): Form
    {
        return $form
            ->columns(7)
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->label(__('tms-ui::tasks/task.form.fields.date'))
                    ->columnSpan(1)
                    ->default(now()),
                // VehiclePicker::make('subject')
                //     ->label(__('tms-ui::tasks/task.form.fields.subject'))
                //     ->columnSpan(1)
                //     // ->relationship('department', 'title')
                //     ->getOptionLabelFromRecordUsing(null)
                //     ->getSearchResultsUsing(null)
                //     ->searchable(),
                // Forms\Components\Select::make('subject_id')
                //     ->label(__('tms-ui::tasks/task.form.fields.subject'))
                //     ->columnSpan(3)
                //     // ->relationship('source', 'title', null, true)
                //     ->options(fn() => Vehicle::pluck('code_1', 'id'))
                //     ->getOptionLabelUsing(fn(Vehicle $record) => "{$record->code->code} - {$record->model->title}")
                //     ->preload()
                //     ->searchable()
                //     // ->disabled(fn($record) => $record->source_id == TicketSource::byCode('planned-maintenance')->first()->id)
                //     ->required(false),
                // subject
                // VehiclePicker::make('subject_id')
                //     ->label(__('tms-ui::tasks/task.form.fields.subject'))
                //     ->getOptionLabelFromRecordUsing(null)
                //     ->getSearchResultsUsing(null)
                //     ->searchable(),
            Forms\Components\Select::make('subject_id')
                ->label(__('tms-ui::tasks/task.form.fields.subject'))
                ->columnSpan(1)
                ->options(EloquentVehicle::whereNotNull('code_1')
                    ->get()
                    ->mapWithKeys(function($vehicle) {
                        return [
                            $vehicle->id => $vehicle->code_1
                        ];
                    })
                )
                // ->getOptionLabelFromRecordUsing(null)
                // ->getSearchResultsUsing(null)
                ->preload()
                ->searchable()
                // ->disabled(fn($record) => $record->source_id == TicketSource::byCode('planned-maintenance')->first()->id)
                ->required(false), 
                // group
                // Forms\Components\Select::make('group_id')
                //     ->label(__('tms-ui::tasks/task.form.fields.group'))
                //     ->relationship('group', 'title')
                //     ->live(),
                // assigned to
                Forms\Components\ToggleButtons::make('assigned_to_id')
                    ->label(__('tms-ui::tasks/task.form.fields.assigned_to'))
                    ->columnSpan(2)
                    ->options(
                        fn() =>
                        EloquentMaintenanceGroup::pluck('code', 'id')
                    )
                    ->inline(),        
                    // title            
                Forms\Components\TextInput::make('title')
                    ->columnSpan(3)
                    ->label(__('tms-ui::tasks/task.form.fields.title')),
                // ->readOnly(fn($record) => $record->source_id == TicketSource::byCode('planned-maintenance')->first()->id)
                // ->disabled(fn($record) => $record->source_id == TicketSource::byCode('planned-maintenance')->first()->id),
                // Forms\Components\ToggleButtons::make('source_id')
                //     ->label(__('tms-ui::tasks/task.form.fields.source'))
                //     ->disabled(fn($record) => $record->source_id == TicketSource::byCode('planned-maintenance')->first()->id)
                //     // ->relationship('source', 'title')
                //     ->inline()
                //     ->columnSpan(7)
                //     ->options(fn() => TicketSource::pluck('title', 'id')),

                // Forms\Components\Select::make('source_id')
                //     ->relationship('source', 'title', null, true)
                //     ->preload()
                //     ->searchable()
                //     ->required(false),
                Forms\Components\Textarea::make('description')
                    ->label(__('tms-ui::tasks/task.form.fields.description'))
                    ->columnSpanFull(),
                // Forms\Components\Select::make('parent_id')
                //     ->relationship('parent', 'title', null, true)
                //     ->preload()
                //     ->searchable()
                //     ->required(false),
                //department
                // DepartmentPicker::make('department_id')
                //     ->label(__('tms-ui::tasks/task.form.fields.department'))
                //     // ->relationship('department', 'title')
                //     ->getOptionLabelFromRecordUsing(null)
                //     ->getSearchResultsUsing(null)
                //     ->searchable()
                //     ->columnSpan(4)
                //     // ->default(function(TicketService $ticketService, $record) {
                //     //return $ticketService->getDepartment($record)->id;
                //     // return 283;
                //     // })
                //     // ->dehydrated(false)
                //     ->required(),
                // vehicle
                // Forms\Components\MorphToSelect::make('subject')
                //     ->types([
                //         MorphToSelect\Type::make(FleetVehicle::class)
                //             ->titleAttribute('code'),
                //     ])
                //     // ->relationship('subject', 'code')
                //     // ->options(fn() => Vehicle::pluck('code', 'id'))
                //     ->preload()
                //     ->searchable(),

                // states
                // Forms\Components\Select::make('state')                                        
                //     ->options(function($record) {
                //         $record->trtransitionableStateInstances();
                //     })
                //     ->preload()
                //     ->searchable(),                    

                // activities 
                // Forms\Components\Tabs::make('Tabs')
                //     ->columnSpanFull()
                //     ->tabs([
                //         // activities
                //         Forms\Components\Tabs\Tab::make('activities')
                //             ->label(__('tms-ui::tasks/task.form.tabs.activities'))
                //             ->badge(3)
                //             ->icon('heroicon-m-wrench')
                //             ->schema([
                //                 ActivityRepeater::make('activities')
                //                 // ->relationship('activities'),
                //             ]),
                //         // materials
                //         Forms\Components\Tabs\Tab::make('materials')
                //             ->label(__('tms-ui::tasks/task.form.tabs.materials'))
                //             ->icon('heroicon-m-rectangle-stack')
                //             ->badge(2)
                //             ->schema([
                //                 MaterialRepeater::make('materials')
                //                 // ->relationship('materials'),
                //             ]),
                //         // services
                //         Forms\Components\Tabs\Tab::make('services')
                //             ->label(__('tms-ui::tasks/task.form.tabs.services'))
                //             ->badge(0)
                //             ->icon('heroicon-m-user-group')
                //             ->schema([
                //                 ServiceRepeater::make('services')
                //                 // ->relationship('services'),
                //             ])
                //     ]),
            ]);
    }
}
