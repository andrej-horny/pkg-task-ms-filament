<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleBrandResource\Forms;

use Filament\Forms;
use Filament\Forms\Form;

class VehicleBrandForm
{
    public static function make(Form $form): Form
    {
        return $form->schema(static::schema());
    }


    public static function schema(): array
    {
        return [
            Forms\Components\TextInput::make('title')
                ->label(__('tms-ui::fleet/vehicle-brand.form.fields.title'))
                ->required(),
        ];
    }
}
