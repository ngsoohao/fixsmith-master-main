<div class="h-screen sm:block lg:flex">
    @livewireStyles

    <div class="flex-shrink-0 mr-5 lg:border-r-2 w-1/7 border-slate-400">
        @include("nav.side-nav")    
    </div>

    <div class="flex-grow w-6/7">
        <h1 class="mb-4 text-2xl font-bold">All Orders</h1>
        <div>
            <input class="w-4/5 mx-auto mb-5 rounded-md"wire:model="search" type="text" placeholder="Search Orders..." />
        
            <table class="items-center text-center">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-white border border-r bg-slate-700 border-slate-600 border-r-white">Order ID</th>
                        <th class="px-4 py-2 text-white border border-r bg-slate-700 border-slate-600 border-r-white">Price</th>
                        <th class="px-4 py-2 text-white border border-r bg-slate-700 border-slate-600 border-r-white">Order Date</th>
                        <th class="px-4 py-2 text-white border border-r bg-slate-700 border-slate-600 border-r-white">Order Time</th>
                        <th class="px-4 py-2 text-white border border-r bg-slate-700 border-slate-600 border-r-white">Status</th>
                        <th class="px-4 py-2 text-white border border-r bg-slate-700 border-slate-600 border-r-white">Service Description</th>
                        <th class="px-4 py-2 text-white border border-r bg-slate-700 border-slate-600 border-r-white">Session ID</th>
                        <th class="px-4 py-2 text-white border border-r bg-slate-700 border-slate-600 border-r-white">Address</th>
                        <th class="px-4 py-2 text-white border border-r bg-slate-700 border-slate-600 border-r-white">Service Provider </th>
                        {{-- <th class="px-4 py-2 text-white border border-r bg-slate-700 border-slate-600 border-r-white">Action</th> --}}

                    </tr>
                </thead>
                @foreach($allOrders as $order)
                    <tr>
                        <td class="px-4 py-2 border border-gray-400">{{ $order->orderID }}</td>
                        <td class="px-4 py-2 border border-gray-400">
                            @if ($order->price) 
                                {{ $order->price }}
                            @else 
                                <p>not quoted</p>
                            @endif
                        </td>
                        <td class="px-4 py-2 border border-gray-400">{{ $order->orderDate }}</td>
                        <td class="px-4 py-2 border border-gray-400">{{ $order->orderTime }}</td>
                        <td class="px-4 py-2 border border-gray-400">{{ $order->status }}</td>
                        <td class="px-4 py-2 border border-gray-400">{{ $order->serviceDescription }}</td>
                        <td class="px-4 py-2 break-all border border-gray-400 max-w-s ">
                            @if ($order->sessionID)
                                {{ $order->sessionID }}
                            @else
                                <p>No payment record found</p>
                            @endif
                        </td>
                        <td class="px-4 py-2 border border-gray-400">
                            <address>
                                {{ $order->location->unitNo }},{{ $order->location->street }},<br>
                                {{ $order->location->city }},<br>
                                {{ $order->location->postCode }},{{ $order->location->state }}
                            </address>
                        </td>
                        <td class="p-2 border border-gray-400">{{ $order->serviceProvider->user->name }}</td>
                        {{-- <td class="p-2 border border-gray-400">
                            <div x-data="{ open: false }" x-cloak>
                                <button class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" @click="open = !open">Expand</button>
                            
                                <div x-show="open">
                                    <p>Hi</p>
                                </div>
                            </div>
                        </td> --}}
                    </tr>
                @endforeach
            </table>
        
            {{ $allOrders->links() }}
        </div>

    </div>

</div>