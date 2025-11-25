<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleTypeResource\Forms;

use Dpb\Package\TaskMS\Application\UseCase\Fleet\CreateVehicleTypeUseCase;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Fleet\EloquentVehicleType;
use Filament\Forms;

class VehicleTypePicker
{
    public static function make(string $uri)
    {
        return Forms\Components\Select::make($uri)
                    // ->relationship('type', 'title')
            ->label(__('tms-ui::fleet/vehicle-type.components.picker.label'))
            ->searchable()
            ->preload()
            ->createOptionForm(VehicleTypeForm::schema())
            ->createOptionModalHeading(__('tms-ui::fleet/vehicle-type.components.picker.create_heading'))
            ->createOptionUsing(function(array $data, CreateVehicleTypeUseCase $vtUseCase) {
                // dd('gg');
                return $vtUseCase->execute($data)->id();
            })
            // ->editOptionForm(VehicleTypeForm::schema())
            // ->editOptionModalHeading(__('tms-ui::fleet/vehicle-type.components.picker.update_heading'))
            ->options(EloquentVehicleType::all()->pluck('title', 'id'))
            ->getOptionLabelUsing(fn ($value): ?string => EloquentVehicleType::find($value)?->title);
    }
}
