<div>
    @livewireStyles
    @include('utils.sessionFlash')
    <div class="min-h-screen md:flex sm:block">

        <div class="flex-shrink-0 mr-5 border-r-2 w-1/7 border-slate-500">
            @include("nav.side-nav")        
        </div>

        <div class="flex-grow overflow-y-auto w-6/7">
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
                    <tr class="text-center">
                        <td class="p-4 border border-slate-600">{{ $insurance->insuranceID }}</td>
                        <td class="p-4 border border-slate-600">
                            <button  wire:ignore wire:click.prevent="toggleOrderDetails({{ $insurance->id }})" class="underline hover:text-slate-400">Click to View Order</button>
                        </td>                              
                        <td class="p-4 border border-slate-600">{{ $insurance->paidAmount }}</td>
                        <td class="p-4 border border-slate-600">{{ $insurance->status }}</td>
                        <td class="p-4 border border-slate-600">
                            <a class="underline hover:text-slate-400" href="{{ route('manage-insurance-request',[$insurance->insuranceID]) }}">
                                    View Submitted Request
                            </a>
                        </td> 
                        <td class="p-4 border border-slate-600"><button class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400">Accept</button></td>
                    </tr>

                    <!-- Order details container -->
                        @if ($showOrderDetails[$insurance->id])
                            <div  class="fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
                                <div class="w-auto p-8 bg-white rounded-md max-w-1/2" >
                                    <div class="mx-auto">
                                        <livewire:view-order-details :orderID='$insurance->orderID'>
                                    </div>
                                    <button wire:click="toggleOrderDetails({{ $insurance->id }})" class="px-4 py-2 mt-4 text-white rounded-md bg-slate-700 hover:bg-slate-400">Close</button>                                    

                                </div>
                                
                            </div>
                        @endif

                    @endforeach
                </tbody>
                

            </table>
                
           
        </div>
    </div>
    

    
    @livewireScripts
</div>