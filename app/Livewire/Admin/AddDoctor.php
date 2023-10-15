<?php

namespace App\Livewire\Admin;

use App\Models\Doctor;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AddDoctor extends Component
{
    use WithFileUploads;

    // Binding Variable
    #[Rule('required|string')] 
    public $name = '';

    #[Rule('nullable|image')] 
    public $image = '';
    
    public function mount() {
        // $this->name = '';
        // $this->image = null;
    }

    public function render()
    {
        return view('livewire.admin.add-doctor')->layout('components.layouts.admin_app');
    }

    public function store_doctor() {
        $this->validate();

        $generator_rules = [
            'table' => 'doctors',
            'length' => '12',
            'prefix' => date('ymd'),
        ];
        $id = IdGenerator::generate($generator_rules);
        
        $Doctor = new Doctor;
        $Doctor->id = $id;
        $Doctor->name = $this->name;
        $Doctor->image = $this->image->store('doctor_profile');

        if ($Doctor->save()) {
            $msg = ['success' => 'Data Dokter tersimpan'];
        } else {
            $msg = ['error' => 'Terjadi kesalahan'];
        }

        $this->dispatch('display-message', $msg);
        $this->name = '';
        $this->image = '';
    }

    public function clear_uploaded_image() {
        $this->image = '';
    }


    

}
