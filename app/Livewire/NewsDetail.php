<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;

class NewsDetail extends Component
{
    // Model Variable
    public $News;
    public $OtherNews;

    public function mount($slug) {
        $requestData = $this->splitString($slug);

        $this->News = News::where([
            ['id', '=', $requestData['id']],
            ['title_slug', '=', $requestData['slug']],
        ])->first();
        
        if (!$this->News) {
            return abort(404);
        }

        $this->OtherNews = News::where('id', '!=', $requestData['id'])->orderBy('created_at', 'DESC')->get()->take(4);
    }

    public function render()
    {
        return view('livewire.news-detail');
    }

    private function splitString($inputString) {
        $parts = explode('-', $inputString);
    
        if (count($parts) >= 2) {
            $slug = implode('-', array_slice($parts, 0, -1));
            $id = end($parts);
    
            return [
                'id' => $id,
                'slug' => $slug,
            ];
        }
    
        return null;
    }
    
}
