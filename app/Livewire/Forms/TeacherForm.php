<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Component;
use App\Models\Assigned;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Hash;

class TeacherForm extends Component
{
    public $name;
    public $email;
    public $dob;

    public $assigned_students = [];

    public function save(){ 
        $validatedData = $this->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'dob' => ['required'],
            'assigned_students' => ['required']
        ]);  

        $selectedStudents = collect($this->assigned_students)
            ->filter(function ($value) {
                return $value === true;
            })
            ->keys()
            ->toArray(); 

        try { 
            $validatedData['password'] = Hash::make($this->dob);
            $newTeacher = User::create($validatedData);  
            
            $assignedData = collect($selectedStudents)->map(function ($id) use ($newTeacher) {
                return [
                    'teacher_id' => $newTeacher->id,
                    'student_id' => $id,
                    'created_at' => now(),
                    'updated_at' => now(), 
                ];
            })->toArray(); 
    
            Assigned::insert($assignedData);   

            session()->flash('success', 'Teacher successfully created.'); 
            $this->reset();
            $this->dispatch('teacher-form');
        } catch (\Exception $e) {
            dd ($e->getMessage());
        } 
    }
    
    #[On('student-form')]
    public function render()
    {
        return view('livewire.forms.teacher-form', [
            'students' => User::where('role', 'student')->get()
        ]);
    }
}
