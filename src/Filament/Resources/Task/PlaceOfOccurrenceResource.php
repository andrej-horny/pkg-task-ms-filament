<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Task;

use Dpb\Package\TaskMSFilament\Filament\Resources\Task\PlaceOfOccurrenceResource\Forms\PlaceOfOccurrenceForm;
use Dpb\Package\TaskMSFilament\Filament\Resources\Task\PlaceOfOccurrenceResource\Pages;
use Dpb\Package\TaskMSFilament\Filament\Resources\Task\PlaceOfOccurrenceResource\Tables\PlaceOfOccurrenceTable;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Tasks\EloquentPlaceOfOccurrence;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class PlaceOfOccurrenceResource extends Resource
{
    protected static ?string $model = EloquentPlaceOfOccurrence::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::tasks/place-of-occurrence.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::tasks/place-of-occurrence.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::tasks/place-of-occurrence.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::tasks/place-of-occurrence.navigation.group');
    }

    public static function getNavigationSort(): ?int
    {
        return config('pkg-tasks.navigation.place-of-occurrence') ?? 999;
    }

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->can('tasks.place-of-occurrence.read');
    // }

    public static function form(Form $form): Form
    {
        return PlaceOfOccurrenceForm::make($form);
    }

    public static function table(Table $table): Table
    {
        return PlaceOfOccurrenceTable::make($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlacesOfOccurrence::route('/'),
            'create' => Pages\CreatePlaceOfOccurrence::route('/create'),
            'edit' => Pages\EditPlaceOfOccurrence::route('/{record}/edit'),
        ];
    }
}
