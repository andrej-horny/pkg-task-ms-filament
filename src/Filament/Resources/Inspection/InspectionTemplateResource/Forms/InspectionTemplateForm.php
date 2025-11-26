<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionTemplateResource\Forms;

use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Fleet\EloquentVehicleModel;
use Filament\Forms;
use Filament\Forms\Form;

class InspectionTemplateForm
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
            Forms\Components\TextInput::make('code')
                ->label(__('tms-ui::inspections/inspection-template.form.fields.code.label'))
                ->columnSpan(1),
            Forms\Components\TextInput::make('title')
                ->label(__('tms-ui::inspections/inspection-template.form.fields.title.label'))
                ->columnSpan(2),
            Forms\Components\TextInput::make('description')
                ->label(__('tms-ui::inspections/inspection-template.form.fields.description.label'))
                ->columnSpan(3),
            // conditions - distance
            Forms\Components\TextInput::make('cnd_distance_treshold')
                ->label(__('tms-ui::inspections/inspection-template.form.fields.treshold_distance.label'))
                ->hint(__('tms-ui::inspections/inspection-template.form.fields.treshold_distance.hint'))
                ->columnSpan(1),
            Forms\Components\TextInput::make('cnd_distance_1adv')
                ->label(__('tms-ui::inspections/inspection-template.form.fields.first_advance_distance.label'))
                ->hint(__('tms-ui::inspections/inspection-template.form.fields.first_advance_distance.hint'))
                ->columnSpan(1),
            Forms\Components\TextInput::make('cnd_distance_2adv')
                ->label(__('tms-ui::inspections/inspection-template.form.fields.second_advance_distance.label'))
                ->hint(__('tms-ui::inspections/inspection-template.form.fields.second_advance_distance.hint'))
                ->columnSpan(1),

            // conditions - time
            Forms\Components\TextInput::make('cnd_time_treshold')
                ->label(__('tms-ui::inspections/inspection-template.form.fields.treshold_time.label'))
                ->hint(__('tms-ui::inspections/inspection-template.form.fields.treshold_time.hint'))
                ->columnSpan(1),
            Forms\Components\TextInput::make('cnd_time_1adv')
                ->label(__('tms-ui::inspections/inspection-template.form.fields.first_advance_time.label'))
                ->hint(__('tms-ui::inspections/inspection-template.form.fields.first_advance_time.hint'))
                ->columnSpan(1),
            Forms\Components\TextInput::make('cnd_time_2adv')
                ->label(__('tms-ui::inspections/inspection-template.form.fields.second_advance_time.label'))
                ->hint(__('tms-ui::inspections/inspection-template.form.fields.second_advance_time.hint'))
                ->columnSpan(1),

            // inspection template groups
            Forms\Components\CheckboxList::make('groups')
                ->label(__('tms-ui::inspections/inspection-template.form.fields.groups.label'))
                ->relationship('groups', 'title')
                ->columnSpan(2),

            // vehicle models 
            Forms\Components\CheckboxList::make('vehicle_models')
                ->label(__('tms-ui::inspections/inspection-template.form.fields.templatables.label'))
                ->hint(__('tms-ui::inspections/inspection-template.form.fields.templatables.hint'))
                ->options(function () {
                    return EloquentVehicleModel::get()
                        ->mapWithKeys(fn ($vm) => [$vm->id => $vm->title]);
                })
                ->bulkToggleable()
                ->searchable()
                ->columns(5)
                ->columnSpan(4)

        ];
    }
}
