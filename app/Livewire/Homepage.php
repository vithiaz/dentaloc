<?php

namespace App\Livewire;

use App\Models\News;
use App\Models\Clinic;
use Livewire\Component;
use Livewire\WithPagination;

class Homepage extends Component
{    
    // Model Variable
    public $Clinic;

    public function mount() {
        $this->Clinic = Clinic::get()->toArray();
    }

    public function render()
    {
        return view('livewire.homepage');
    }
}
