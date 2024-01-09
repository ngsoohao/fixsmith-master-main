<div>
    <div class="min-h-screen md:flex sm:block">

        <div class="mr-5 border-r-2 w-1/7 border-slate-500">
            @include("nav.side-nav")        
        </div>

        <div class="overflow-y-auto w-6/7">

            
            <div class="overflow-x-auto">
                <h1 class="pt-2 pb-2 text-lg font-bold">Incoming Job</h1>

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-center text-white border-2 border-slate-700 bg-slate-700">
                            <th class="p-4 border border-gray-300">OrderID</th>
                            <th class="p-4 border border-gray-300">Service Type</th>
                            <th class="p-4 border border-gray-300">Scheduled Date Time</th>
                            <th class="p-4 border border-gray-300">Location</th>
                            <th class="p-4 border border-gray-300">Description</th>
                            <th class="p-4 border border-gray-300">Price (RM)</th>
                            <th class="p-4 border border-gray-300">Status</th>
                            <th class="p-4 border border-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($orders)
                        @foreach ($orders as $order)
                       
                            
                        
                            <tr class="text-center transition hover:bg-gray-100">
                                <td class="p-4 border border-slate-600">{{ $order->orderID }}</td>
                                <td class="p-4 border border-slate-600">{{ $order->serviceProvider->serviceType->serviceTypeName }}</td>
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
                                <td class="max-w-xs p-4 break-words border border-slate-600">{{ $order->serviceDescription }}</td>
                                <td class="p-4 border border-slate-600">
                                    @if ($order->price)
                                        {{ $order->price }}
                                    @else
                                    <label class="text-sm">Quote a price</label><br>
                                    <input class="w-2/3" wire:model="price.{{ $order->orderID }}">
                                    @endif
                                </td>
                                <td class="p-4 border border-slate-600">{{ $order->status }}</td>
                                <td class="p-4 border border-slate-600">
                                    {{-- Status list and flow
                                        1-when order created ->pending
                                        2-when handymen accepted and quoted -> quoted
                                        3-when customer paid -> paid
                                        4-when handymen complete the order ->completed
                                         --}}
                                    @if ($order->status =='pending')
                                        <button class="px-4 py-2 mb-2 text-white rounded-md bg-slate-700 text-md hover:bg-slate-400" wire:click='acceptAndQuote({{$order->orderID}})'>Quote And Accept</button>
                                        <button class="px-4 py-2 mb-2 text-white bg-red-700 rounded-md hover:bg-red-400 text-md" wire:click='declineIncomingOrder({{ $order->orderID }})'>Decline</button>

                                    @elseif($order->status =='quoted')
                                    <p>Pending Payment</p>
                                    @elseif($order->status =='paid')
                                    <label class="text-sm">Click when job done</label><br>
                                    <button class="px-4 py-2 text-white rounded-md hover:bg-slate-400 bg-slate-700 text-md" wire:click='jobDone({{$order->orderID}})'>Job Done</button>
                                    
                                    @elseif($order->status=='delivered')
                                    <p></p>
                                    @elseif($order->status =='completed')
                                    <p>Complete</p>
                                    @else
                                    <p>Invalid Order</p>
                                    @endif
                                </td>
                            </tr>
                            
                        @endforeach
                        @else
                        <p>No orders available.</p>
                        @endif

                       
                    </tbody>
                </table>
                {{-- job History..............................................................................................................  --}}

                <h1 class="pt-2 pb-2 text-lg font-bold">Job History</h1>

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-center text-white border-2 border-slate-500 bg-slate-500">
                            <th class="p-4 border border-gray-300">OrderID</th>
                            <th class="p-4 border border-gray-300">Service Type</th>
                            <th class="p-4 border border-gray-300">Scheduled Date Time</th>
                            <th class="p-4 border border-gray-300">Location</th>
                            <th class="p-4 border border-gray-300">Description</th>
                            <th class="p-4 border border-gray-300">Price (RM)</th>
                            <th class="p-4 border border-gray-300">Status</th>
                            <th class="p-4 border border-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobHistory as $order)
                            <tr class="text-center transition hover:bg-gray-100">
                                <td class="p-4 border border-slate-600">{{ $order->orderID }}</td>
                                <td class="p-4 border border-slate-600">{{ $order->serviceProvider->serviceType->serviceTypeName }}</td>
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
                                <td class="max-w-xs p-4 break-words border border-slate-600">{{ $order->serviceDescription }}</td>
                                <td class="p-4 border border-slate-600">
                                    @if ($order->price)
                                        {{ $order->price }}
                                    @else
                                        <p>not quoted</p>
                                    @endif
                                </td>
                                <td class="p-4 border border-slate-600">{{ $order->status }}</td>
                                <td class="p-4 border border-slate-600">
                                    {{-- Status list and flow
                                        1-when order created ->pending
                                        2-when handymen accepted and quoted -> quoted
                                        3-when customer paid -> paid
                                        4-when handymen complete the order ->completed
                                         --}}
                                    @if ($order->status =='pending')
                                        <button class="px-4 py-2 text-white rounded-md bg-slate-700 text-md" wire:click='acceptAndQuote({{$order->orderID}})'>Accept and Quote</button>
                                        
                                    @elseif($order->status =='quoted')
                                    <p>Pending Payment</p>
                                    @elseif($order->status =='paid')
                                    <button class="px-4 py-2 text-white rounded-md bg-slate-700 text-md" wire:click='jobDone({{$order->orderID}})'>Job Done</button>
                                    @elseif($order->status =='completed')
                                    <p>Order Completed</p>
                                    @else
                                    <p>Invalid Order</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>