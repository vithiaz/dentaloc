<?php

namespace App\Livewire\Admin;

use App\Models\Clinic;
use Livewire\Component;
use Livewire\WithPagination;

class ClinicList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // Model Variable
    public $ClinicsModel;

    public function updatedPage() {
        $this->dispatch('changed-page');
    }

    public function render()
    {
        $clinics = Clinic::paginate(8);
        $this->ClinicsModel = $clinics->items();
        
        return view('livewire.admin.clinic-list', ['clinics' => $clinics])->layout('components.layouts.admin_app');
    }

    public function getData() {
        $this->dispatch('render-map', $this->ClinicsModel);
    }
}
