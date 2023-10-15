<?php

namespace App\Livewire\Admin;

use App\Models\News;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AddNews extends Component
{
    use WithFileUploads;

    // Binding Variable
    #[Rule('required|string')] 
    public $title;
    #[Rule('required|string')] 
    public $body;
    #[Rule('nullable|image')] 
    public $image;

    public function render()
    {
        return view('livewire.admin.add-news')->layout('components.layouts.admin_app');
    }

    public function clear_uploaded_image() {
        $this->image = '';
    }

    public function store_news() {
        $this->validate();

        $generator_rules = [
            'table' => 'news',
            'length' => '12',
            'prefix' => date('ymd'),
        ];
        $id = IdGenerator::generate($generator_rules);

        $News = new News;
        $News->id = $id;
        $News->title = $this->title;
        $News->title_slug = Str::slug($this->title);
        $News->body = $this->body;
        $News->image = $this->image->store('news');
        $News->save();

        return redirect()->route('admin.news-list')->with('message', 'Berita Ditambahkan');
    }
}
