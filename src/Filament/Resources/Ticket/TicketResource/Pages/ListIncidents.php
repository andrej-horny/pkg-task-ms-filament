<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource\Pages;

use Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource;
use Dpb\Package\Tickets\Models\TicketType;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make()
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return '';
    } 

    public function getTabs(): array
    {
        $tabs = [];

        // Default “all” tab
        $tabs['all'] = Tab::make('Všetky');

        // Dynamic tabs
        foreach (TicketType::get() as $type) {
            $tabs[$type->code] = Tab::make($type->title)
                ->modifyQueryUsing(
                    function (Builder $query) use ($type) {
                        $query->whereHas('incident', function ($q) use ($type) {
                            $q->byType($type->code);
                        });
                    }
                );
        }

        return $tabs;
    }
}
