<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionTemplateGroupResource\Forms;

use Filament\Forms;
use Filament\Forms\Form;

class InspectionTemplateGroupForm
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
            // code
            Forms\Components\TextInput::make('code')
                ->label(__('tms-ui::inspections/inspection-template-group.form.fields.code.label'))
                ->columnSpan(1),
            // title
            Forms\Components\TextInput::make('title')
                ->label(__('tms-ui::inspections/inspection-template-group.form.fields.title'))
                ->columnSpan(3),
            // description
            Forms\Components\Textarea::make('description')
                ->label(__('tms-ui::inspections/inspection-template-group.form.fields.description'))
                ->columnSpanFull()
                ->rows(10)
                ->cols(20),
        ];

    }
}
