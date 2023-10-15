<?php

namespace App\Livewire\Admin;

use App\Models\Clinic;
use App\Models\Doctor;
use Livewire\Component;
use App\Models\ClinicImage;
use Livewire\Attributes\On;
use App\Models\ClinicDoctor;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AddClinic extends Component
{
    use WithFileUploads;

    // Binding Variable
    public $name = '';
    public $long = '';
    public $lat = '';
    public $open_time = '';
    public $closed_time = '';
    public $description = '';
    public $images = [];
    public $image_uploads = [];


    public $listed_doctor = [];

    #[On('add-doctor')]
    public function append_doctor($data) {
        if (!$this->in_listed_doctor($data['doctor_id'])) {
            array_push($this->listed_doctor, $data);
        } else {
            foreach($this->listed_doctor as $index=>$doctor) {
                if ($doctor['doctor_id'] == $data['doctor_id']) {
                    $this->listed_doctor[$index]['start_hours'] = $data['start_hours'];
                    $this->listed_doctor[$index]['end_hours'] = $data['end_hours'];
                }
            }
        }
    }

    
    public function updatedImages() {
        $this->validate([
            'images.*' => 'image|max:8192',
        ]);
        $this->image_uploads = array_merge($this->image_uploads, $this->images);
        $this->images = [];
    }


    protected $rules = [
        'name' => 'required|string',
        'long' => 'required',
        'lat' => 'required',
        'open_time' => 'required',
        'closed_time' => 'required',
        'description' => 'nullable',
    ];

    protected $messages = [
        'name.required' => 'nama klinik harus diisi',
        'name.string' => 'nama klinik harus berupa text',
        'long.required' => 'longtitude harus diisi',
        'lat.required' => 'lattitude harus diisi',
        'open_time.required' => 'waktu buka harus diisi',
        'closed_time.required' => 'waktu tutup harus diisi',
    ];


    public function render()
    {
        return view('livewire.admin.add-clinic')->layout('components.layouts.admin_app');
    }

    public function store_clinic() {
        $this->validate();

        $generator_rules = [
            'table' => 'clinics',
            'length' => '12',
            'prefix' => date('ymd'),
        ];
        $id = IdGenerator::generate($generator_rules);

        $clinic = new Clinic;
        $clinic->id = $id;
        $clinic->name = $this->name;
        $clinic->long = $this->long;
        $clinic->lat = $this->lat;
        $clinic->open_time = $this->open_time;
        $clinic->closed_time = $this->closed_time;
        $clinic->description = $this->description;
        $clinic->save();


        foreach ($this->listed_doctor as $doctor) {
            $clinic_doctor = new ClinicDoctor;
            $clinic_doctor->doctor_id = $doctor['doctor_id'];
            $clinic_doctor->clinic_id = $clinic->id;
            $clinic_doctor->operation_start = $doctor['start_hours'];
            $clinic_doctor->operation_end = $doctor['end_hours'];
            $clinic_doctor->save();
        }

        foreach ($this->image_uploads as $image) {
            $clinic_image = new ClinicImage;
            $clinic_image->image = $image->store('clinic_images');
            $clinic_image->clinic_id = $clinic->id;
            $clinic_image->save();
        }

        return redirect()->route('admin.clinic-list')->with('message', 'Klinik Ditambahkan');
    }

    public function remove_uploaded_images($index) {
        unset($this->image_uploads[$index]);
    }

    public function get_doctor_info($doctor_id) {
        $doctor = Doctor::find($doctor_id);
        return $doctor;
    }


    private function in_listed_doctor($check_id) {
        foreach ($this->listed_doctor as $doctor) {
            if (isset($doctor['doctor_id']) && $doctor['doctor_id'] === $check_id) {
                return true;
            }
        }

        return false;
    }

    public function pop_listed_doctor($doctor_id) {
        foreach ($this->listed_doctor as $index=>$doctor) {
            if (isset($doctor['doctor_id']) && $doctor['doctor_id'] == $doctor_id ) {
                unset($this->listed_doctor[$index]);
            }
        }
    }




    


}
