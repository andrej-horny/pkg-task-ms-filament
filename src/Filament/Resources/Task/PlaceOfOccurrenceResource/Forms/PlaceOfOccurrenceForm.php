<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task\PlaceOfOccurrenceResource\Forms;

use Filament\Forms;
use Filament\Forms\Form;

class PlaceOfOccurrenceForm
{
    public static function make(Form $form): Form
    {
        return $form->schema(static::schema());
    }

    public static function schema(): array
    {
        return [
            // uri
            Forms\Components\TextInput::make('uri')
                ->label(__('tms-ui::tasks/place-of-occurrence.form.fields.uri.label'))
                ->hint(__('tms-ui::tasks/place-of-occurrence.form.fields.uri.hint')),
            // title
            Forms\Components\TextInput::make('title')
                ->label(__('tms-ui::tasks/place-of-occurrence.form.fields.title')),
        ];
    }
}
