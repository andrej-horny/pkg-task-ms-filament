<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleTypeResource\Forms;

use Filament\Forms;
use Filament\Forms\Form;

class VehicleTypeForm
{
    public static function make(Form $form): Form
    {
        return $form->schema(static::schema());
    }

    public static function schema(): array
    {
        return [
            Forms\Components\TextInput::make('code')
                ->label(__('tms-ui::fleet/vehicle-type.form.fields.code.label')),
            Forms\Components\TextInput::make('title')
                ->label(__('tms-ui::fleet/vehicle-type.form.fields.title')),
        ];
    }
}
