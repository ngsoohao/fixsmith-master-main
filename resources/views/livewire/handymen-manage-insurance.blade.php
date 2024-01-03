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
                                    @if($currentState[$insurance->insuranceID]=='accepted')
                                    <button class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" >Add Service Proof</button>
                                    @endif
        
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @livewireScripts
</div>