<?php

use function Livewire\Volt\{state, rules};

state(['username', 'email']);

rules(fn () => [
    'username' => ['required', 'min:6'],
    'email' => ['required', 'email']
]);

$submit = function () {
    $this->validate();
}; ?>

<form wire:submit.prevent="submit">
    <input type="text" wire:model="username">
    @error('username')
        {{ $message }}
    @enderror
    <input type="text" wire:model="email">
    @error('email')
        {{ $message }}
    @enderror

    <button type="submit">Submit</button>
    {{ $username ?? '' }}
    {{ $email ?? '' }}
</form> 
