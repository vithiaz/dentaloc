<?php

namespace App\Livewire;

use App\Models\Clinic;
use Livewire\Component;

class ClinicListPage extends Component
{
    // Model Variable
    public $Clinic;
    public $search;

    // Binding Variable
    public $clinic_count;
    public $open_clinic_count;

    public function mount() {
        $currentTime = date("H:i:s");
                
        $this->Clinic = Clinic::get()->toArray();
        $this->search = '';
        
        $this->clinic_count = count($this->Clinic);
        $this->open_clinic_count = Clinic::where([
            ['open_time' , '<=', $currentTime],
            ['closed_time' , '>=', $currentTime],
        ])->get()->count();

    }

    public function render()
    {
        if ($this->search) {
            $clinic_filter = Clinic::where('name', 'LIKE', '%'.$this->search.'%')->get();
        } else {
            $clinic_filter = Clinic::get();
        }
        return view('livewire.clinic-list-page', ['clinic_filter' => $clinic_filter]);
    }
}
