<?php

namespace App\Livewire\Admin\Components\AddDoctor;

use Livewire\Component;
use Livewire\Attributes\Rule;

class AddDoctorCard extends Component
{
    // Binding Variable
    public $doctor;
    
    #[Rule('required')] 
    public $start_hours;
    
    #[Rule('required')] 
    public $end_hours;


    public function mount($doctor) {
        $this->doctor = $doctor;
        $this->start_hours = '';
        $this->end_hours = '';
    }

    public function render()
    {
        return view('livewire.admin.components.add-doctor.add-doctor-card');
    }

    public function add_doctors() {
        $this->validate();

        $this->dispatch('add-doctor', [
            'doctor_id' => $this->doctor->id,
            'start_hours' => $this->start_hours,
            'end_hours' => $this->end_hours,
            ])->to(\App\Livewire\Admin\AddClinic::class);
        
        $this->dispatch('add-doctor', [
            'doctor_id' => $this->doctor->id,
            'start_hours' => $this->start_hours,
            'end_hours' => $this->end_hours,
            ])->to(\App\Livewire\Admin\EditClinic::class);
    }
}
