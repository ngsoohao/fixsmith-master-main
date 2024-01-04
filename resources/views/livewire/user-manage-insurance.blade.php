<div>
    @livewireStyles
    @include('utils.sessionFlash')
        <section class="min-h-screen md:flex sm:block">

            <div class="flex-shrink-0 mr-5 border-r-2 w-1/7 border-slate-500">
                @include("nav.side-nav")        
            </div>

            <div class="flex-grow overflow-auto w-6/7">
                <section>
                    <h1 class="pt-2 pb-2 text-lg font-bold">My Protected Orders</h1>

                    <table class="flex-grow">
                        <thead>
                            <tr class="text-center text-white border-2 border-slate-700 bg-slate-700">
                                <th class="p-4 border border-gray-300">Insurance ID</th>
                                <th class="p-4 border border-gray-300">Protected Orders</th>
                                <th class="p-4 border border-gray-300">Amount Paid</th>
                                <th class="p-4 border border-gray-300">Start Date</th>
                                <th class="p-4 border border-gray-300">Expired </th>
                                <th class="p-4 border border-gray-300">Status</th>
                                <th class="p-4 border border-gray-300">Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($insurances as $insurance)
                            <tr class="text-center">
                                <td class="p-4 border border-slate-600">{{ $insurance->insuranceID }}</td>
                                <td class="p-4 border border-slate-600"><a href="{{ route('view-insured-orders',[$insurance->insuranceID]) }}" class="underline hover:text-slate-400">Click to view order</a></td>
                                <td class="p-4 border border-slate-600"><p>RM{{ $insurance->paidAmount }}</p></td>
                                <td class="p-4 border border-slate-600">{{ $insurance->startDate }}</td>
                                <td class="p-4 border border-slate-600">{{ $insurance->expiredDate }}</td>
                                <td class="p-4 border border-slate-600">{{ $insurance->status }}</td>
                                <td class="p-4 border border-slate-600">
                                    @if ($currentState[$insurance->insuranceID]==!NULL)
                                    <p class="mb-3 font-bold">Current status :{{ $currentState[$insurance->insuranceID] ?? 'N/A' }}</p>
                                    @endif
                                    <a class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" href="{{ route('manage-insurance-request',[$insurance->insuranceID]) }}">
                                        Add Or View Claim Request
                                    </a>  
                                </td>
                                
                            </tr>       
                            @endforeach
                        </tbody>   
                    </table> 
                </section>
                {{-- view user insurance history-------------------------------------------------------------------------------------------------- --}}
                <section>
                    <h1 class="pt-2 pb-2 text-lg font-bold"> Protected Orders History</h1>

                    <table class="flex-grow">
                        <thead>
                            <tr class="text-center text-white border-2 border-slate-500 bg-slate-500">
                                <th class="p-4 border border-gray-300">Insurance ID</th>
                                <th class="p-4 border border-gray-300">Protected Orders</th>
                                <th class="p-4 border border-gray-300">Amount Paid</th>
                                <th class="p-4 border border-gray-300">Start Date</th>
                                <th class="p-4 border border-gray-300">Expired </th>
                                <th class="p-4 border border-gray-300">Status</th>
                                <th class="p-4 border border-gray-300">Action</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($insuranceHistories as $insuranceHistory)
                            <tr class="text-center">
                                <td class="p-4 border border-slate-600">{{ $insuranceHistory->insuranceID }}</td>
                                <td class="p-4 border border-slate-600"><a href="{{ route('view-insured-orders',[$insuranceHistory->insuranceID]) }}" class="underline hover:text-slate-400">Click to view order</a></td>
                                <td class="p-4 border border-slate-600"><p>RM{{ $insuranceHistory->paidAmount }}</p></td>
                                <td class="p-4 border border-slate-600">{{ $insuranceHistory->startDate }}</td>
                                <td class="p-4 border border-slate-600">{{ $insuranceHistory->expiredDate }}</td>
                                <td class="p-4 border border-slate-600">{{ $insuranceHistory->status }}</td>
                                <td class="p-4 border border-slate-600"></td>
                                
                            </tr>       
                            @endforeach
                        </tbody>   
                    </table> 
                </section>
                
            </div>
        </section>
    @livewireScripts
</div>