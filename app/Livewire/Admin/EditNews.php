<?php

namespace App\Livewire\Admin;

use App\Models\News;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditNews extends Component
{
    use WithFileUploads;

    // Model Variable
    public $News;

    // Binding Variable
    #[Rule('required|string')] 
    public $title;
    #[Rule('required|string')] 
    public $body;
    #[Rule('nullable|image')] 
    public $image;

    public $image_state_changed;

    public function updatedImage() {
        $this->image_state_changed = true;
    }

    public function mount($id) {
        $this->News = News::find($id);
        
        if (!$this->News) {
            return abort(404);
        }
        
        $this->title = $this->News->title;
        $this->body = $this->News->body;
        $this->image = $this->News->image;
        $this->image_state_changed = false;
    }

    public function render()
    {
        return view('livewire.admin.edit-news')->layout('components.layouts.admin_app');
    }

    public function reset_uploaded_image() {
        $this->uploaded_image = null;
    }

    public function store_news() {
        $this->validate();

        $this->News->title = $this->title;
        $this->News->title_slug = Str::slug($this->title);
        $this->News->body = $this->body;

        if ($this->image_state_changed) {
            Storage::delete($this->News->image);
            $this->News->image = $this->image->store('news');
        }
    
        $this->News->save();

        return redirect()->route('admin.news-list')->with('message', 'Perubahan disimpan');
    }

}
