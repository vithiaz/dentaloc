<?php

namespace App\Livewire;

use App\Models\Clinic;
use Livewire\Component;

class ClinicDetail extends Component
{

    // Binding Variable
    public $clinic_id;

    // Model Variable
    public $Clinic;

    public function mount($id) {
        $this->clinic_id = $id;

        $this->Clinic = Clinic::with(['images', 'clinic_doctors'])->find($this->clinic_id)->toArray();
        
        if (!$this->Clinic) {
            return abort(404);
        }

    }

    public function render()
    {
        return view('livewire.clinic-detail');
    }


}
