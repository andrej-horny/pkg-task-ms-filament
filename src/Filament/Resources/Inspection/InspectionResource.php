<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Inspection;

use Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionResource\Forms\InspectionFrom;
use Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionResource\Pages;
use Dpb\Package\TaskMSFilament\Filament\Resources\Inspection\InspectionResource\Tables\InspectionTable;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Inspections\EloquentInspection;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class InspectionResource extends Resource
{
    protected static ?string $model = EloquentInspection::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::inspections/inspection.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::inspections/inspection.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::inspections/inspection.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::inspections/inspection.navigation.group');
    }

    public static function getNavigationSort(): ?int
    {
        return config('pkg-inspections.navigation.inspection') ?? 999;
    }

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->can('inspections.inspection.read');
    // }

    public static function form(Form $form): Form
    {
        return InspectionFrom::make($form);
    }

    public static function table(Table $table): Table
    {
        return InspectionTable::make($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInspections::route('/'),
            'create' => Pages\CreateInspection::route('/create'),
            'edit' => Pages\EditInspection::route('/{record}/edit'),
        ];
    }

    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()
    //         // ->byVehicleType('A');
    //         ->byMaintenanceGroup('1TPA');
    // }
}
