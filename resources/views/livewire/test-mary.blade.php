<div>  
    <x-file wire:model="photo" accept="image/png, image/jpeg">
        <img src="{{ $user->avatar ?? '/empty-user.jpg' }}" class="h-40 rounded-lg" />
    </x-file>
</div>