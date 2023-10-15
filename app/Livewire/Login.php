<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{

    // Binding Variable
    #[Rule('required|email|string')]
    public $email;

    #[Rule('required|string')]
    public $password;

    public function mount() {
        $this->email = '';
        $this->password = '';
    }

    public function render()
    {
        return view('livewire.login');
    }

    public function login() {
        $this->validate();
        
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->dispatch('refresh-page');
        } else {
            session()->flash('failed-login', 'email atau password salah');
        }

    }

}
