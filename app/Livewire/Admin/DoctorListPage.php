<?php

namespace App\Livewire\Admin;

use App\Models\Doctor;
use Livewire\Component;
use Livewire\WithPagination;

class DoctorListPage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    private $PAGINATION_ITEM = 12;

    public function mount() {
        
    }

    public function render()
    {
        $Doctors = Doctor::paginate($this->PAGINATION_ITEM);

        return view('livewire.admin.doctor-list-page', ['doctors' => $Doctors])->layout('components.layouts.admin_app');
    }
}
