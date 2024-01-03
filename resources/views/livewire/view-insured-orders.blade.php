<div class="py-2 ">
    @livewireStyles
    <section class="rounded-lg bg-zinc-200">

        <div class="max-w-2xl mx-auto"> 
            <h1 class="text-xl font-bold ">Insured Orders</h1>

            <div class="p-4 ">
                <div class="mb-4">
                    <h2 class="font-bold text-md">OrderID</h2>
                    <div class="p-2 bg-white rounded-md ">
                        {{ $insuredOrders->orderID }}
                    </div>
                </div>

                <div class="mb-4">
                    <h2 class="font-bold text-md">Price (excluding insurance)</h2>
                    <div class="p-2 bg-white rounded-md ">
                        {{ $insuredOrders->price }}
                    </div>
                </div>

                <div class="mb-4">
                    <h2 class="font-bold text-md">Order Date And Time</h2>
                    <div class="p-2 bg-white rounded-md ">
                        <p>Serviced on {{ $insuredOrders->orderDate }} at {{ $insuredOrders->orderTime }}</p>
                    </div>
                </div>

                <div class="mb-4">
                    <h2 class="font-bold text-md">Service Address</h2>
                    <div class="p-2 bg-white rounded-md ">
                        <p> {{ $insuredOrders->location->unitNo }},{{ $insuredOrders->location->street }}<br>
                            {{ $insuredOrders->location->city }},<br>
                            {{ $insuredOrders->location->postCode }},{{ $insuredOrders->location->state }}
                        </p>
                    </div>
                </div>

                <div class="mb-4">
                    <h2 class="font-bold text-md">Handymen</h2>
                    <div class="p-2 bg-white rounded-md ">
                        {{ $insuredOrders->serviceProvider->user->name }}
                    </div>
                </div>



                
                
            </div>
            
        </div>
    </section>
    @livewireScripts
</div>