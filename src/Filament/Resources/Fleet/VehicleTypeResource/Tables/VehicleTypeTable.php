<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Fleet\VehicleTypeResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class VehicleTypeTable
{
    public static function make(Table $table): Table
    {
        return $table
            ->paginated([10, 25, 50, 100, 'all'])
            ->defaultPaginationPageOption(100)
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label(__('tms-ui::fleet/vehicle-type.table.columns.code.label')),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('tms-ui::fleet/vehicle-type.table.columns.title.label')),
            ])
            ->headerActions([])
            ->actions([
                Tables\Actions\EditAction::make(),
                    // ->visible(auth()->user()->can('fleet.vehicle-model.update')),
                Tables\Actions\DeleteAction::make(),
                    // ->visible(auth()->user()->can('fleet.vehicle-model.delete')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(auth()->user()->can('fleet.vehicle-model.bulk-delete')),
                ]),
            ]);
    }
}
