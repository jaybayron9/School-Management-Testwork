<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    public function mount() {
        if (Auth::check()) {
            return redirect('/teacher');
        }
    }

    public function login() {
        $validatedData = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($validatedData))
            return redirect('/teacher');  

        $this->addError('invalid', 'Invalid email or password.'); 
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
