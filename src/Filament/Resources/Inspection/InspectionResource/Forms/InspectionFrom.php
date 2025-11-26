<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionResource\Forms;

use Dpb\Package\TaskMSFilament\Filament\Components\VehiclePicker;
use Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionTemplateResource\Forms\InspectionTemplatePicker;
use Carbon\Carbon;
use Dpb\Package\Fleet\Models\Vehicle;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Fleet\EloquentVehicle;
use Filament\Forms;
use Filament\Forms\Form;

class InspectionFrom
{
    public static function make(Form $form): Form
    {
        return $form->schema(static::schema());
    }

    public static function schema(): array
    {
        return [
            // date
            Forms\Components\DatePicker::make('date')
                ->label(__('tms-ui::inspections/inspection.form.fields.date'))
                ->default(Carbon::now()),
            // subject
            Forms\Components\Select::make('subject_id')
                ->label(__('tms-ui::inspections/inspection.form.fields.subject'))
                ->options(
                    EloquentVehicle::with('model')->get()
                        // ->mapWithKeys(fn(EloquentVehicle $vehicle) => [$vehicle->id => $vehicle->code->code . ' - ' . $vehicle->model?->title])
                        ->mapWithKeys(fn(EloquentVehicle $vehicle) => [$vehicle->id => '' . ' - ' . $vehicle->model?->title])
                )
                ->searchable(),
            // template
            InspectionTemplatePicker::make('template_id')
                ->label(__('tms-ui::inspections/inspection.form.fields.template'))
                ->relationship('template', 'title'),

            // ->relationship('template', 'title'),
            // Forms\Components\TextInput::make('description')
            //     ->columnSpan(1)
            //     ->label(__('fleet/maintenance-group.form.fields.description')),
            // Forms\Components\ColorPicker::make('color')
            //     ->columnSpan(1)
            //     ->label(__('fleet/maintenance-group.form.fields.color')),
        ];
    }
}
