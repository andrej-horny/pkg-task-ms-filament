<?php

namespace Dpb\Package\TaskMSFilament\Filament\Resources\Ticket;

use Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource\Forms\TicketAssignmentForm;
use Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource\Forms\TicketForm;
use Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource\Pages;
use Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource\Tables\TicketAssignmentTable;
use Dpb\Package\TaskMSFilament\Filament\Resources\Ticket\TicketResource\Tables\TicketTable;
use Dpb\Package\TaskMSFilament\Models\TicketAssignment;
use Dpb\Package\Tickets\Models\Ticket;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class TicketResource extends Resource
{
    protected static ?string $model = TicketAssignment::class;
    // protected static ?string $model = Ticket::class;

    public static function getModelLabel(): string
    {
        return __('tms-ui::tickets/ticket.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('tms-ui::tickets/ticket.resource.plural_model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('tms-ui::tickets/ticket.navigation.label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('tms-ui::tickets/ticket.navigation.group');
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can('incidents.incident.read');
    }

    public static function form(Form $form): Form
    {
        return TicketAssignmentForm::make($form);
        // return TicketForm::make($form);
    }

    public static function table(Table $table): Table
    {
        return TicketAssignmentTable::make($table);
        // return TicketTable::make($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
