<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleModelResource\Forms;

use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleBrandResource\Forms\VehicleBrandPicker;
use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\Vehicle\VehicleTypeResource\Forms\VehicleTypePicker;
use Dpb\Package\Activities\Models\ActivityTemplate;
use Filament\Forms;
use Filament\Forms\Form;

class ActivityTemplatesTab
{
    public static function make(): array
    {
        return [

            Forms\Components\Repeater::make('activity_templates')
                ->hiddenLabel()
                ->simple(
                    Forms\Components\Select::make('template')
                    ->options(fn () => ActivityTemplate::pluck('title', 'id'))
                    ->searchable()
                    // Forms\Components\Select::make('template')
                    // ->options()
                    // ->searchable()                    
                )
                ->addable()
                ->deletable()
                ->itemNumbers()
                ->orderable(false)
                
                // ->label(__('tms-ui::fleet/vehicle-model.form.fields..label'))
                // ->numeric(),
        ];
    }
}
