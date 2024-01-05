<?php

namespace App\Livewire\Tables;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class TeacherTable extends Component
{
    #[On('teacher-form')]
    public function render()
    {
        return view('livewire.tables.teacher-table', [
            'teachers' => User::where('role', 'teacher')->get()
        ]);
    }
}
