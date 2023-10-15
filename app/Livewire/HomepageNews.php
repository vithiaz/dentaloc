<?php

namespace App\Livewire;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class HomepageNews extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $News = News::orderBy('created_at', 'DESC')->paginate(8, pageName: 'news-page');
        return view('livewire.homepage-news', ['News' => $News]);
    }
}
