<div class="container md:mx-auto pb-10 flex justify-center"> 
    <div> 
        <div class="flex justify-between items-center">
            <h1 class="font-semibold text-2xl mt-5">
                Admin
            </h1>
            <a href="{{ route('login') }}" wire:navigate class="mt-5 text-sm text-blue-500 hover:underline">Login Teacher</a>
        </div>
        <div class="grid md:grid-cols-2 gap-3 mt-5"> 
            <div class="col-span-2 bg-gray-50 rounded-md shadow-md border border-gray-200"> 
                <div class="md:flex justify-between w-full">
                    <div class="border-r-4 border-gray-300 p-5 w-full">  
                        <livewire:forms.teacher-form/>
                    </div>
                    <div class="p-5 w-full"> 
                        <livewire:forms.student-form/>
                    </div>
                </div>
            </div> 
            <div>
                <div class="bg-gray-50 rounded-md shadow-md p-4 border border-gray-200">
                    <livewire:tables.teacher-table/>
                </div>
            </div>
            <div>
                <div class="bg-gray-50 rounded-md shadow-md p-4 border border-gray-200">
                    <livewire:tables.student-table/>
                </div>
            </div>
        </div>
    </div>
</div>
