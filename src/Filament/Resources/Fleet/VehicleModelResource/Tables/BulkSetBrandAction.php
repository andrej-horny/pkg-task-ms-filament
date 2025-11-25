<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleModelResource\Tables;

use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleBrandResource\Forms\VehicleBrandPicker;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

class BulkSetBrandAction
{
    public static function make($uri): BulkAction
    {
        return BulkAction::make($uri)
            ->label(__('tms-ui::fleet/vehicle-model.table.actions.bulk_set_brand'))
            ->form([
                VehicleBrandPicker::make('brand_id')
            ])
            ->action(function (array $data, Collection $records) {
                // dd($records);
                foreach ($records as $record) {
                    $record->brand_id = $data['brand_id'];
                    $record->save();
                }
            });
    }
}
