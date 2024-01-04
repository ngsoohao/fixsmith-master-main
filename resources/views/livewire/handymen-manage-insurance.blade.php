<div>
    @livewireStyles
    @include('utils.sessionFlash')

    <div class="min-h-screen md:flex sm:block">

        <div class="flex-shrink-0 mr-5 border-r-2 w-1/7 border-slate-500">
            @include("nav.side-nav")        
        </div>

        <div class="flex-grow overflow-y-auto w-6/7">
            <section>
                <h1 class="pt-2 pb-2 text-lg font-bold">Handle Customer Insurance Claim</h1>

                <table class="flex-grow">
                    <thead>
                        <tr class="text-center text-white border-2 border-slate-700 bg-slate-700">
                            <th class="p-4 border border-gray-300">Insurance ID</th>
                            <th class="p-4 border border-gray-300">Protected Orders</th>
                            <th class="p-4 border border-gray-300">Amount Paid</th>
                            <th class="p-4 border border-gray-300">Status</th>
                            <th class="p-4 border border-gray-300">Customer Request</th>
                            <th class="p-4 border border-gray-300">Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($insurances as $insurance)
                            @if ($currentState[$insurance->insuranceID]==!NULL) 
                                <tr class="text-center">
                                    <td class="p-4 border border-slate-600">{{ $insurance->insuranceID }}</td>
                                    <td class="p-4 border border-slate-600">
                                        <a href="{{ route('view-insured-orders',[$insurance->insuranceID]) }}" class="underline">Click To View Order</a>
                                    </td>                              
                                    <td class="p-4 border border-slate-600">{{ $insurance->paidAmount }}</td>
                                    <td class="p-4 border border-slate-600">{{ $insurance->status }}</td>
                                    <td class="p-4 border border-slate-600">
                                        
                                        <p class="mb-3 font-bold">Current status :{{ $currentState[$insurance->insuranceID] ?? 'N/A' }}</p>
                                        
                                        <a class="underline hover:text-slate-400" href="{{ route('manage-insurance-request',[$insurance->insuranceID]) }}">
                                                View Submitted Request
                                        </a>
                                    </td> 
                                    <td class="p-4 border border-slate-600">
                                        @if($currentState[$insurance->insuranceID]=='requested')
                                        <div x-data="{ declineReason: false}">
                                            <button class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click="acceptClaimRequest({{ $insurance->insuranceID }})">Accept</button>
                                            <button @click="declineReason = true" class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" >Decline</button>

                                            <div x-show="declineReason" @click.outside="declineReason = false" class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
                                                <div class="w-1/2 p-4 bg-white rounded-md ">
                                                    <label for="fileInput">Reason of Decline</label>
                                                    <input type="text" wire:ignore wire:model.lazy="declineReason" class="block w-full mb-4" >
                                                    @include('utils.alert-error')
                                                    <button  class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400 "wire:click='rejectClaimRequest({{ $insurance->insuranceID }})'>Submit</button>
                                                    <button class="px-4 py-2 ml-2 text-white bg-red-500 rounded-md hover:bg-red-700" @click="declineReason = false">Close</button>

                                                </div>
                                            </div>
                                        </div>

                                        

                                        
                                        @elseif ($currentState[$insurance->insuranceID]=='accepted')
                                        <div x-data="{ isOpen: false}">
                                            <!-- Add Service Proof Button -->
                                            <button @click="isOpen = true" class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400">Add Service Proof</button>
                                        
                                            <!-- Hidden Window -->
                                            <div x-show="isOpen"  @click.outside="isOpen = false" class="fixed top-0 left-0 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
                                                <div class="p-4 bg-white rounded-md">
                                                    <label for="fileInput">Upload File:</label>
                                                    <input type="file" wire:model="serviceProof" class="block mb-4" >
                                        
                                                    <!-- Image preview -->
                                                    @if ($serviceProof)
                                                    <img src="{{ $serviceProof->temporaryUrl() }}" alt="preview" class="mt-4" width="200" height="200">
                                                    @endif                                    

                                                    <button class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click='completeClaimRequest({{ $insurance->insuranceID }})'>Upload</button>
                                        
                                                    <button class="px-4 py-2 ml-2 text-white bg-red-500 rounded-md hover:bg-red-700" @click="isOpen = false">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
            
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </section>
            {{-- view insurance claim history------------------------------------------------------------------------------------------ --}}
            <section>
                <h1 class="pt-2 pb-2 text-lg font-bold">Insurance Claim History</h1>

                <table class="flex-grow">
                    <thead>
                        <tr class="text-center text-white border-2 border-slate-500 bg-slate-500">
                            <th class="p-4 border border-gray-300">Insurance ID</th>
                            <th class="p-4 border border-gray-300">Protected Orders</th>
                            <th class="p-4 border border-gray-300">Amount Paid</th>
                            <th class="p-4 border border-gray-300">Status</th>
                            <th class="p-4 border border-gray-300">Customer Request</th>
                            <th class="p-4 border border-gray-300">Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($insuranceHistories as $insuranceHistory)
                                <tr class="text-center">
                                    <td class="p-4 border border-slate-600">{{ $insuranceHistory->insuranceID }}</td>
                                    <td class="p-4 border border-slate-600">
                                        <a href="{{ route('view-insured-orders',[$insuranceHistory->insuranceID]) }}" class="underline">Click To View Order</a>
                                    </td>                              
                                    <td class="p-4 border border-slate-600">{{ $insuranceHistory->paidAmount }}</td>
                                    <td class="p-4 border border-slate-600">{{ $insuranceHistory->status }}</td>
                                    <td class="p-4 border border-slate-600">
                                                                                
                                        <a class="underline hover:text-slate-400" href="{{ route('manage-insurance-request',[$insuranceHistory->insuranceID]) }}">
                                                View Submitted Request
                                        </a>
                                    </td> 
                                    <td class="p-4 border border-slate-600">
                                        
            
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
            
        </div>
    </div>
    @livewireScripts
</div>