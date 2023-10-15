<?php

namespace App\Livewire\Admin;

use App\Models\Doctor;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditDoctor extends Component
{
    use WithFileUploads;

    // Model Variable
    public $Doctor;

    // Binding Variable
    #[Rule('required|string')] 
    public $name = '';

    #[Rule('nullable|image')]
    public $image = null;
    
    public $image_state_changed;

    public function updatedImage() {
        $this->image_state_changed = true;
    }
    
    public function mount(Doctor $doctor) {
        $this->Doctor = $doctor;
        if (!$this->Doctor) {
            return abort(404);
        }

        $this->name = $this->Doctor->name;
        $this->image = $this->Doctor->image;
        $this->image_state_changed = false;
    }
    
    public function render()
    {
        return view('livewire.admin.edit-doctor')->layout('components.layouts.admin_app');
    }

    public function store_doctor() {

        $this->Doctor->name = $this->name;
        if ($this->image_state_changed) {
            Storage::delete($this->Doctor->image);
            $this->Doctor->image = $this->image->store('doctor_profile');
        }
        $this->Doctor->save();

        return redirect()->route('admin.doctor-list')->with('message', 'perubahan disimpan');
    }
    
    public function reset_uploaded_image() {
        $this->uploaded_image = null;
    }

}
