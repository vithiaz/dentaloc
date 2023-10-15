<?php

namespace App\Livewire\Admin\Components\AddDoctor;

use App\Models\Doctor;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class DoctorList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    private $pagination_count = 5;
    
    // Binding Variable
    public $search;
    
    public function updatedSearch() {
        $this->resetPage(pageName: 'add-doctor-page');
    }
        
    public function mount() {
        $this->search = '';
    }

    public function render()
    {
        if ($this->search != '') {
            $doctors = Doctor::where('id', 'like', '%' . $this->search . '%')
                                ->orWhere('name', 'like', '%' . $this->search . '%')
                                ->paginate($this->pagination_count, pageName: 'add-doctor-page');
        } else {
            $doctors = Doctor::paginate($this->pagination_count, pageName: 'add-doctor-page');
        }
        

        return view('livewire.admin.components.add-doctor.doctor-list', [
            'doctors' => $doctors,
        ]);
    }


    


}
