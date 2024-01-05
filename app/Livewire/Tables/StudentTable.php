<?php

namespace App\Livewire\Tables;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class StudentTable extends Component
{
    #[On('student-form')]
    public function render()
    {
        return view('livewire.tables.student-table', [
            'students' => User::where('role', 'student')->get()
        ]);
    }
}
