<div>
    @livewireStyles
    @include('utils.sessionFlash')
    <div class="min-h-screen md:flex sm:block">

        <div class="flex-shrink-0 mr-5 border-r-2 w-1/7 border-slate-500">
            @include("nav.side-nav")        
        </div>

        <div class="flex-grow overflow-y-auto w-6/7">
            <h1 class="pt-2 pb-2 text-lg font-bold">My Protected Orders</h1>

            <table class="flex-grow">
                <thead>
                    <tr class="text-center text-white border-2 border-slate-700 bg-slate-700">
                        <th class="p-4 border border-gray-300">Insurance ID</th>
                        <th class="p-4 border border-gray-300">Protected Orders</th>
                        <th class="p-4 border border-gray-300">Amount Paid</th>
                        <th class="p-4 border border-gray-300">Start Date</th>
                        <th class="p-4 border border-gray-300">Expired (RM)</th>
                        <th class="p-4 border border-gray-300">Status</th>
                        <th class="p-4 border border-gray-300">Action</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($insurances as $insurance)
                    <tr class="text-center">
                        <td class="p-4 border border-slate-600">{{ $insurance->insuranceID }}</td>
                        <td class="p-4 border border-slate-600"><button onclick="toggleForm()" class="underline hover:text-slate-400">Click to view order</button></td>
                        <td class="p-4 border border-slate-600">{{ $insurance->paidAmount }}</td>
                        <td class="p-4 border border-slate-600">{{ $insurance->startDate }}</td>
                        <td class="p-4 border border-slate-600">{{ $insurance->expiredDate }}</td>
                        <td class="p-4 border border-slate-600">{{ $insurance->status }}</td>
                        <td class="p-4 border border-slate-600">
                            <a class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" href="{{ route('manage-insurance-request',[$insurance->insuranceID]) }}">
                                Add Or View Claim Request
                            </a>  
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
                

            </table>
                
           
        </div>
    </div>
    

    {{-- hidden window that show order details --}}

    <div id="orderDetails"   class="fixed top-0 bottom-0 left-0 right-0 z-50 items-center justify-center hidden bg-gray-800 bg-opacity-75" wire:ignore>
        <div class="w-auto p-8 bg-white rounded-md max-w-1/2" >
            <div class="mx-auto">
                @foreach ($orderDetails as $orderDetail)
                <div class="flex">
                    <h1 class="text-xl font-bold">Order Details</h1>
                    <div class="ml-40">
                        <button onclick="toggleForm()" >
                            <i class="flex flex-row-reverse hover:text-red-500 fa-solid fa-xmark"></i>
    
                        </button>
                    </div>
                </div>

                <div class="flex mb-4">
                    <div>
                        <img class="object-cover w-32 h-32 ml-2 mr-10 rounded-full" src="{{ $orderDetail->serviceProvider->user->profile_photo_url }}" width="100" height="100">
                    </div>
                    <div class="">
                        <h4 class="mb-5 text-lg font-bold">{{$orderDetail->serviceProvider->user->name}}</h4>
                    </div>
                    
                </div>
                
                <div class="flex mb-4">
                    <div>
                        <strong>Service Location</strong>
                        <address>
                            {{ $orderDetail->location->unitNo }},{{ $orderDetail->location->street }}<br>
                            {{ $orderDetail->location->city }},<br>
                            {{ $orderDetail->location->postCode }},{{ $orderDetail->location->state }}
                        </address>
                    </div>

                    <div class="ml-6">
                        <strong>Date and Time</strong><br>
                        {{ $orderDetail->orderDate }},<br>
                        {{ $orderDetail->orderTime }}
                    </div>
                </div>

                <div class="mb-6">
                    <strong>Description</strong><br>
                    {{ $orderDetail->serviceDescription }}
                </div>

                <div>
                    <strong>Price (exclude the insurance)</strong><br>
                    RM{{ $orderDetail->price }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @livewireScripts
    
    <script>
        function toggleForm() {
            var form = document.getElementById('orderDetails');
            form.classList.toggle('hidden');
            form.classList.toggle('flex');  
        }
    </script>

    <script src="https://kit.fontawesome.com/930fd65046.js" crossorigin="anonymous"></script>

    @bukScripts(true)
</div>