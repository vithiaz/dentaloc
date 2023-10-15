<?php

namespace App\Livewire\Admin;

use App\Models\Clinic;
use App\Models\Doctor;
use Livewire\Component;
use App\Models\ClinicImage;
use Livewire\Attributes\On;
use App\Models\ClinicDoctor;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditClinic extends Component
{
    use WithFileUploads;

    // Route Binding Variable
    public $clinicId;

    // Model Variable
    public $Clinic;

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

    public $db_doctors = [];
    public $db_doctor_state_delete = [];

    public $db_images = [];
    public $db_images_state_delete = [];



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


    public function mount($id) {
        $this->clinicId = $id;

        $this->Clinic = Clinic::with(['images', 'clinic_doctors'])->find($id);
        
        if (!$this->Clinic) {
            return abort(404);
        }

        $this->name = $this->Clinic->name;
        $this->long = $this->Clinic->long;
        $this->lat = $this->Clinic->lat;
        $this->open_time = $this->Clinic->open_time;
        $this->closed_time = $this->Clinic->closed_time;
        $this->description = $this->Clinic->description;

        // db_images
        if ($this->Clinic->images->count() > 0) {
            foreach ($this->Clinic->images as $image) {
                array_push($this->db_images, $image);
            }
        }

        // db_doctors
        if ($this->Clinic->clinic_doctors->count() > 0) {
            foreach ($this->Clinic->clinic_doctors as $clinic_doctor) {
                array_push($this->db_doctors, $clinic_doctor);
            }
        }
        
        $this->dispatch('render-map', $this->Clinic);
    }

    public function render()
    {
        return view('livewire.admin.edit-clinic')->layout('components.layouts.admin_app');
    }


    public function save_changed() {
        $this->validate();

        $this->Clinic->name = $this->name;
        $this->Clinic->long = $this->long;
        $this->Clinic->lat = $this->lat;
        $this->Clinic->open_time = $this->open_time;
        $this->Clinic->closed_time = $this->closed_time;
        $this->Clinic->description = $this->description;
        $this->Clinic->save();

        foreach ($this->listed_doctor as $doctor) {
            $clinic_doctor = new ClinicDoctor;
            $clinic_doctor->doctor_id = $doctor['doctor_id'];
            $clinic_doctor->clinic_id = $this->Clinic->id;
            $clinic_doctor->operation_start = $doctor['start_hours'];
            $clinic_doctor->operation_end = $doctor['end_hours'];
            $clinic_doctor->save();
        }

        foreach ($this->image_uploads as $image) {
            $clinic_image = new ClinicImage;
            $clinic_image->image = $image->store('clinic_images');
            $clinic_image->clinic_id = $this->Clinic->id;
            $clinic_image->save();
        }

        // Delete image_state_delete
        if ($this->db_images_state_delete) {
            foreach ($this->db_images_state_delete as $delete_id) {
                $ClinicImageDelete = ClinicImage::find($delete_id);
                if ($ClinicImageDelete) {
                    Storage::delete($ClinicImageDelete->image);
                    $ClinicImageDelete->delete();
                }
            }   
        }
        
        // Delete clinic_doctor_state_delete
        if ($this->db_doctor_state_delete) { 
            foreach ($this->db_doctor_state_delete as $delete_id) {
                $ClinicDoctorDelete = ClinicDoctor::find($delete_id);
                if ($ClinicDoctorDelete) {
                    $ClinicDoctorDelete->delete();
                }
            }
        }
        

        return redirect()->route('admin.clinic-list')->with('message', 'perubahan disimpan');
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

    public function in_listed_delete_state($values, $list, $checkKey) {
        foreach ($list as $item) {
            if ($checkKey) {
                if (isset($checkKey) && $item[$checkKey] == $values) {
                    return true;
                }
            } else {
                if ($item == $values) {
                    return true;
                }
            }
        }
        return false;
    }

    public function append_delete_doctor($clinic_doctor_id) {
        array_push($this->db_doctor_state_delete, $clinic_doctor_id);
    }

    public function append_delete_uploaded_image($image_id) {
        array_push($this->db_images_state_delete, $image_id);
    }

}
