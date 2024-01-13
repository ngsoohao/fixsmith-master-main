<div>
    @include('utils.sessionFlash')

    <div class="min-h-screen md:flex sm:block">

        <div class="mr-5 border-r-2 w-1/7 border-slate-500">
            @include("nav.side-nav")        
        </div>

        <div class="flex-grow overflow-y-auto w-6/7">

           

            <div class="overflow-x-auto">
                <h1 class="pt-2 pb-2 text-lg font-bold">My Booking</h1>

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-center text-white border-2 border-slate-700 bg-slate-700">
                            <th class="p-4 border border-gray-300">OrderID</th>
                            <th class="p-4 border border-gray-300">Scheduled Date Time</th>
                            <th class="p-4 border border-gray-300">Location</th>
                            <th class="p-4 border border-gray-300">Handymen</th>
                            <th class="p-4 border border-gray-300">Service Type</th>
                            <th class="p-4 border border-gray-300">Description</th>
                            <th class="p-4 border border-gray-300">Estimate Price (RM)</th>
                            <th class="p-4 border border-gray-300">Price (RM)</th>
                            <th class="p-4 border border-gray-300">Status</th>
                            <th class="p-4 border border-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="text-center transition hover:bg-gray-100">
                                <td class="p-4 border border-slate-600">{{ $order->orderID }}</td>
                                <td class="p-4 border border-slate-600">{{ $order->orderDate }}<br>{{ $order->orderTime }}</td>
                                <td class="max-w-xs p-4 break-words border border-slate-600">
                                    <address>
                                        {{ $order->location->unitNo }},
                                        {{ $order->location->street }},<br>
                                        {{ $order->location->city }}
                                        {{ $order->location->postCode}},<br>
                                        {{ $order->location->state }}.
                                    </address>
                                    
                                </td>
                                <td class="p-4 border border-slate-600">{{ $order->serviceProvider->user->name }}</td>
                                <td class="p-4 border border-slate-600">{{ $order->serviceProvider->serviceType->serviceTypeName }}</td>
                                <td class="max-w-xs p-4 break-words border border-slate-600">{{ $order->serviceDescription }}</td>
                                <td class="max-w-xs p-4 break-words border border-slate-600">
                                    @if ($order->quoteMin && $order->quoteMax)
                                        RM{{ $order->quoteMin }}
                                        <p>to</p>
                                        RM{{ $order->quoteMax }}
                                    @endif
                                </td>
                                <td class="p-4 border border-slate-600">
                                    @if ($order->price)
                                        {{ $order->price }}
                                    @else
                                        <p>pending</p>
                                    @endif
                                </td>
                                <td class="p-4 border border-slate-600">{{ $order->status }}</td>
                                <td class="p-4 border border-slate-600">
                                    @if($order->status =='pending')
                                    <button class="px-4 py-2 text-white rounded-md bg-slate-700 text-md"wire:click="cancelOrder({{$order->orderID}})">Cancel</button>
                                    
                                    @elseif($order->status =='quoted')
                                    <button class="px-4 py-2 text-white rounded-md bg-slate-700 text-md" wire:click="acceptQuotedRange({{ $order->orderID }})">Accept Quote</button>
                                    
                                    @elseif($order->status =='price updated')
                                    <a class="px-4 py-2 text-white rounded-md bg-slate-600 hover:bg-slate-400 text-md" href="{{route('checkout',[$order->orderID])}}">Checkout</a>

                                    @elseif($order->status =='delivered')
                                    <button class="px-4 py-2 mb-5 text-white rounded-md bg-slate-600 hover:bg-slate-400 text-md"wire:click="orderComplete({{$order->orderID}})">Complete</button>
                                    <button class="px-4 py-2 mt-2 text-white bg-red-600 rounded-md hover:bg-red-400 text-md" wire:click='appealIncompleteOrder({{ $order->orderID }})'>Incomplete</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- Order History..............................................................................................................  --}}
                <h1 class="pt-2 pb-2 text-lg font-bold">Booking History</h1>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-center text-white border-2 border-slate-500 bg-slate-500">
                            <th class="p-4 border border-gray-300">OrderID</th>
                            <th class="p-4 border border-gray-300">Price (RM)</th>
                            <th class="p-4 border border-gray-300">Scheduled Date Time</th>
                            <th class="p-4 border border-gray-300">Location</th>
                            <th class="p-4 border border-gray-300">Handymen</th>
                            <th class="p-4 border border-gray-300">Service Type</th>
                            <th class="p-4 border border-gray-300">Description</th>
                            <th class="p-4 border border-gray-300">Status</th>
                            <th class="p-4 border border-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderHistory as $order)
                            <tr class="text-center transition hover:bg-gray-100">
                                <td class="p-4 border border-slate-600">{{ $order->orderID }}</td>
                                <td class="p-4 border border-slate-600">
                                    @if ($order->price)
                                        {{ $order->price }}
                                    @else
                                        <p>pending</p>
                                    @endif
                                </td>
                                <td class="p-4 border border-slate-600">{{ $order->orderDate }}<br>{{ $order->orderTime }}</td>
                                <td class="max-w-xs p-4 break-words border border-slate-600">
                                    <address>
                                        {{ $order->location->unitNo }},
                                        {{ $order->location->street }},<br>
                                        {{ $order->location->city }}
                                        {{ $order->location->postCode}},<br>
                                        {{ $order->location->state }}.
                                    </address>
                                    
                                </td>
                                <td class="p-4 border border-slate-600">{{ $order->serviceProvider->user->name }}</td>
                                <td class="p-4 border border-slate-600">{{ $order->serviceProvider->serviceType->serviceTypeName }}</td>
                                <td class="max-w-xs p-4 break-words border border-slate-600">{{ $order->serviceDescription }}</td>
                                <td class="p-4 border border-slate-600">{{ $order->status }}</td>
                                <td class="p-4 border border-slate-600">
                                    @if($order->status =='pending')
                                    <button class="px-4 py-2 text-white rounded-md bg-slate-700 text-md"wire:click="cancelOrder(({{$order->orderID}}))">Cancel</button>


                                    @elseif($order->status =='quoted')
                                    <a class="px-4 py-2 text-white rounded-md bg-slate-600 hover:bg-slate-400 text-md" href="{{route('checkout',[$order->orderID])}}">Checkout</a>

                                    @elseif($order->status=='completed')
                                    <a class="px-4 py-2 text-white rounded-md bg-slate-600 hover:bg-slate-400 text-md" href="{{route('manage-review',[$order->orderID])}}">Leave a review</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
        @if(session('alert'))
            <script>
                alert("{{ session('alert') }}");
            </script>
        @endif
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alertMessage = document.getElementById('alertMessage');
    
            if (alertMessage) {
                setTimeout(function() {
                    alertMessage.style.display = 'none';
                }, 3000); // 3000 milliseconds = 3 seconds
            }
        });
    </script>
</div>