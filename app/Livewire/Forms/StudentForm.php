<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class StudentForm extends Component
{
    public $name;
    public $email;
    public $dob;

    public function save(){ 
        $validatedData = $this->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'dob' => ['required'],
        ]);

        $validatedData['role'] = 'student'; 
        $validatedData['password'] = Hash::make($this->dob);  

        try {
            User::create($validatedData); 
            session()->flash('success', 'Student successfully created.');
        } catch (\Exception $e) {
            dd ($e->getMessage());
        }

        $this->reset();
        $this->dispatch('student-form');
    }
    public function render()
    {
        return view('livewire.forms.student-form');
    }
}
