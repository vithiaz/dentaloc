<?php

namespace App\View\Components;

use Closure;
use App\Models\Doctor;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class DoctorCard extends Component
{

    public $id;
    public $name;
    public $timeStart;
    public $timeEnd;
    public $image;
    
    public function __construct(
        $id,
        $timeStart,
        $timeEnd,
    )
    {
        $this->id = $id;
        $this->timeStart = getHoursMinutes($timeStart);
        $this->timeEnd = getHoursMinutes($timeEnd);

        $Doctor = Doctor::find($this->id);
        $this->name = $Doctor->name;
        $this->image = $Doctor->image;
    }


    public function render(): View|Closure|string
    {
        return view('components.doctor-card');
    }
}
