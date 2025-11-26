<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource\Forms;

use Dpb\Package\TaskMSFilament\Filament\Components\VehiclePicker;
use Carbon\Carbon;
use Dpb\Package\Fleet\Models\Vehicle;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Fleet\EloquentVehicle;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Tickets\EloquentTicketType;
use Dpb\Package\Tickets\Models\TicketType;
use Dpb\Package\Tickets\Models\TicketGroup;
use Filament\Forms;
use Filament\Forms\Form;

class TicketForm
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
                ->label(__('tms-ui::tickets/ticket.form.fields.date'))
                ->columnSpan(1)
                ->default(Carbon::now()),
            // subject
            // Forms\Components\Select::make('subject_id')
            //     ->label(__('tickets/ticket.form.fields.subject'))
            //     ->columnSpan(1)
            //     // ->relationship('source', 'title', null, true)
            //     ->options(
            //         fn() => Vehicle::with(['codes', 'model:id,title'])

            //             ->get()
            //             ->mapWithKeys(fn($vehicle) => [$vehicle->id => $vehicle->code->code . ' - ' . $vehicle->model?->title])
            //     )
            //     ->getSearchResultsUsing(function (string $search) {
            //         // return Vehicle::whereHas('codes', function ($q) use ($search) {
            //         //     $q->where('code', 'like', "%{$search}%");
            //         // })
            //         //     ->with(['codes' => fn($q) => $q->where('code', 'like', "%{$search}%")->orderByDesc('date_from')])
            //         //     ->get()
            //         //     ->mapWithKeys(function (Vehicle $vehicle) {
            //         //         $latestCode = $vehicle->codes->first();
            //         //         if (!$latestCode) {
            //         //             return []; // important: return empty array if no code
            //         //         }
            //         //         return [
            //         //             $vehicle->id => $latestCode->code . ' - ' . $vehicle->model->title,
            //         //         ];
            //         //     })
            //         //     ->toArray(); // must return array
            //         return                  Vehicle::whereHas('codes', function ($q) use ($search) {
            //             $q->whereLike('code', "%{$search}%")
            //                 ->orderByDesc('date_from')
            //                 ->first();
            //         })
            //             // ->orWhereLike('title', "%{$search}%")
            //             ->get()
            //             ->mapWithKeys(fn(Vehicle $vehicle) => [$vehicle->id => $vehicle->code->code . ' - ' . $vehicle->model->title]);
            //     })
            // VehiclePicker::make('subject_id')
            //     ->label(__('tms-ui::tickets/ticket.form.fields.subject'))
            //     ->columnSpan(1)
            //     ->options(Vehicle::with(['codes', 'model'])
            //         ->get()
            //         ->mapWithKeys(function($vehicle) {
            //             return [
            //                 $vehicle->id => $vehicle->code->code . ' - ' . $vehicle->model?->title
            //             ];
            //         })
            //     )
            //     ->getOptionLabelFromRecordUsing(null)
            //     ->getSearchResultsUsing(null)
            //     ->preload()
            //     ->searchable(),
                // ->disabled(fn($record) => $record->source_id == TicketSource::byCode('planned-maintenance')->first()->id)
                // ->required(false),
                // subject
            Forms\Components\Select::make('subject_id')
                ->label(__('tms-ui::tickets/ticket.form.fields.subject'))
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
            // ticket type            
            Forms\Components\ToggleButtons::make('type_id')
                ->label(__('tms-ui::tickets/ticket.form.fields.type'))
                ->inline()
                ->columnSpan(1)
                ->options(
                    fn() =>
                    EloquentTicketType::pluck('title', 'id')
                ),
            // description
            Forms\Components\Textarea::make('description')
                ->label(__('tms-ui::tickets/ticket.form.fields.description'))
                ->columnSpanFull()
                ->rows(10)
                ->cols(20),
        ];

    }
}
