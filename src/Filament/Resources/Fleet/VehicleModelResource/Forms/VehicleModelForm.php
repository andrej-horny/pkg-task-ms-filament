<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleModelResource\Forms;

use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleBrandResource\Forms\VehicleBrandPicker;
use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleTypeResource\Forms\VehicleTypePicker;
use Filament\Forms;
use Filament\Forms\Form;

class VehicleModelForm
{
    public static function make(Form $form): Form
    {
        return $form
            ->schema([
                // brand
                VehicleBrandPicker::make('brand_id'),

                // title
                Forms\Components\TextInput::make('title')
                    ->label(__('tms-ui::fleet/vehicle-model.form.fields.title.label')),
                //year
                Forms\Components\TextInput::make('year')
                    ->label(__('tms-ui::fleet/vehicle-model.form.fields.year.label'))
                    ->numeric(),
                // type
                VehicleTypePicker::make('type_id'),

                // Forms\Components\Tabs::make('Tabs')
                //     ->columnSpanFull()
                //     ->tabs([
                //         Forms\Components\Tabs\Tab::make(__('tms-ui::fleet/vehicle-model.form.tabs.activity-templates'))
                //             ->schema(ActivityTemplatesTab::make()),
                //         Forms\Components\Tabs\Tab::make(__('tms-ui::fleet/vehicle-model.form.tabs.parameters'))
                //             ->schema(ParametersTab::make()),
                //     ])
            ]);
    }
}
