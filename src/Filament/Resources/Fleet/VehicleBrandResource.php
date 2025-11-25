<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet;

use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleBrandResource\Forms\VehicleBrandForm;
use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleBrandResource\Pages;
use Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleBrandResource\Tables\VehicleBrandTable;
use Dpb\Package\TaskMS\Infrastructure\Persistence\Eloquent\Models\Fleet\EloquentVehicleBrand;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class VehicleBrandResource extends Resource
{
    protected static ?string $model = EloquentVehicleBrand::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::fleet/vehicle-brand.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::fleet/vehicle-brand.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::fleet/vehicle-brand.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::fleet/vehicle-brand.navigation.group');
    }

    public static function getNavigationSort(): ?int
    {
        return config('pkg-fleet.navigation.brand') ?? 999;
    }

    // public static function canViewAny(): bool
    // {
    //     return auth()->user()->can('fleet.vehicle-brand.read');
    // }

    public static function form(Form $form): Form
    {
        return VehicleBrandForm::make($form);
    }

    public static function table(Table $table): Table
    {
        return VehicleBrandTable::make($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicleBrands::route('/'),
            'create' => Pages\CreateVehicleBrand::route('/create'),
            'edit' => Pages\EditVehicleBrand::route('/{record}/edit'),
        ];
    }
}
