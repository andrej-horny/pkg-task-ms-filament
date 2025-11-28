<?php

namespace App\Filament\Resources\TS\TaskItemResource\Components;

use App\Services\TS\MaterialService;
use Dpb\Package\Tasks\Models\TaskItem;
use Livewire\Component;

class TaskItemMaterials extends Component
{
    // public TaskItem $ticketItem;
    public $materials;
    public $totalMaterialExpenses;

    public function mount(
        TaskItem $ticketItem,
        MaterialService $materialSvc
    ) {
        // expense materials
        $this->materials = $materialSvc->getMaterials($ticketItem->ticket);
        $this->totalMaterialExpenses = $materialSvc->getTotalMaterialExpenses($ticketItem->ticket);
    }

    public function render()
    {
        return view('filament.resources.ts.ticket-item-resource.components.ticket-item-materials');
    }
}
