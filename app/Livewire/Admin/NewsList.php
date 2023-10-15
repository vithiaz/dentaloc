<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class NewsList extends Component
{
    public function render()
    {
        return view('livewire.admin.news-list')->layout('components.layouts.admin_app');
    }
}
