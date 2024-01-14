<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mary\Traits\WithMediaSync;
use Illuminate\Validation\Rule;
use Ramsey\Collection\Collection;

class TestMary extends Component
{  
    use WithFileUploads, WithMediaSync;
 
    // Temporary files
    #[Rule(['files.*' => 'image|max:1024'])]
    public array $files = [];
  
    #[Rule('required')]
    public Collection $library; 
 
    public function save(): void
    { 
        $this->syncMedia($this->user); 
    }

    public function render()
    {
        return view('livewire.test-mary');
    }
}
