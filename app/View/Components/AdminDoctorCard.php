<?php

namespace App\View\Components;

use Closure;
use App\Models\Doctor;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AdminDoctorCard extends Component
{
    // Model Variable
    public $doctor;
    
    // Binding Variable


    public function __construct(Doctor $doctor)
    {
        $this->doctor = $doctor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-doctor-card');
    }
}
