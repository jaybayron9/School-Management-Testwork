<div class="container mx-auto">
    <div class="py-4">
        <a href="{{ route('logout') }}" class="underline text-blue-500 hover:no-underline">Logout</a>
    </div>  
    <div>
        <h3 class="mb-4 text-lg font-semibold">Welcome Teacher <span class="capitalize">{{ auth()->user()->name }}</span> </h3> 
    </div>
    <div>   
        <div class="flex justify-between items-center">
            <h3>Your student(s)</h3>
            <div class="flex gap-3">
                <a href="{{ route('export.csv') }}" class="border border-gray-500 rounded-md px-3 py-1 text-sm active:shadow-md">
                    Export CSV
                </a>  
                <div  x-data="{
                        showModal: false,
                    }"
                >
                    <button 
                        @click="showModal = true"
                        class="border border-gray-500 rounded-md px-3 py-1 text-sm active:shadow-md">
                        Import CSV
                    </button>

                    <div x-show="showModal" x-transition x-cloak class="flex items-center justify-center fixed top-0 left-0 right-0 z-50 h-full w-full overflow-auto bg-gray-800 bg-opacity-50"> 
                        <div class="relative p-4 w-full max-w-2xl max-h-full"> 
                            <form wire:submit="importCSV" class="relative bg-white rounded-lg shadow"> 
                                <input type="hidden" wire:model="assign_id" />
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                    <h3 class="text-xl font-semibold text-gray-900">
                                        Import CSV
                                    </h3>
                                    <button type="button" @click="showModal = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div> 
                                <div class="p-4 md:p-5 space-y-4">
                                    @error('csvSuccess')
                                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert"> 
                                            <span class="block sm:inline text-sm">{{ $message }}</span>
                                        </div> 
                                    @enderror
                                    <input  
                                        id="import"
                                        type="file" 
                                        wire:model="csvFile" 
                                        class="block w-full text-sm text-gray-900 cursor-pointer"
                                    />    

                                    <div wire:loading wire:target="csvFile"> 
                                        <span class="text-sm text-gray-600">Importing...</span>
                                    </div>
                                    @error('csvFile')<span class="text-xs text-red-500">{{ $message }}</span>@enderror
                                </div>
                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b"> 
                                    @if($csvFile)
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            <div wire:click="importCSV" wire:loading.remove wire:target="importCSV">
                                                Import
                                            </div>
                                            <div wire:loading wire:target="importCSV">
                                                Importing
                                            </div>
                                        </button> 
                                    @endif
                                    <button type="button" @click="showModal = false" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                                        Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th class="text-xs whitespace-nowrap text-center">ID</th>
                    <th class="text-xs whitespace-nowrap text-center">NAME</th>
                    <th class="text-xs whitespace-nowrap text-center">EMAIL</th>
                    <th class="text-xs whitespace-nowrap text-center">BIRTHDAY</th>
                    <th class="text-xs whitespace-nowrap text-center">SCORE</th>
                    <th class="text-xs whitespace-nowrap text-center">STATUS</th>
                    <th class="text-xs whitespace-nowrap text-center">CREATED AT</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td class="text-sm p-2 capitalize">{{ $student->student_id }}</td>
                        <td class="text-sm p-2 capitalize">{{ $student->name }}</td>
                        <td class="text-sm p-2">{{ $student->email }}</td>
                        <td class="text-sm p-2 capitalize">{{ $student->dob }}</td>
                        <td class="text-sm p-2 capitalize">{{ $student->score }}</td>
                        <td class="text-sm p-2 capitalize flex justify-center">  
                            @if ($student->status)
                            <span 
                                class=" {{ $student->status === 'passed' ? 'bg-green-500' : 'bg-red-500' }}
                                font-semibold px-4 py-1 rounded-md text-white"
                            >
                                {{ $student->status  }}
                            </span> 
                            @else
                                <span class="bg-gray-100 font-semibold px-4 py-1 rounded-md text-dark">
                                    No Result
                                </span> 
                            @endif
                        </td>
                        <td class="text-sm p-2 capitalize">{{ date('Y/m/d', strtotime($student->created_at)) }}</td> 
                    </tr>
                @endforeach
            </tbody>
        </table>  
    </div> 
</div>
