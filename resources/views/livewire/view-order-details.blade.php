<div>
    @livewireStyles
    <div>
        <div class="flex">
            <h1 class="text-xl font-bold">Order Details</h1>
        </div>

        <div class="flex mb-2">
            
            <div class="mt-2">

                <h4 class="mb-5 text-lg font-bold">Customer Name: {{$orders->user->name}}</h4>
            </div>
            
        </div>
        
        <div class="flex mb-4">
            <div>
                <strong>Service Location</strong>
                <address>
                    {{ $orders->location->unitNo }},{{ $orders->location->street }}<br>
                    {{ $orders->location->city }},<br>
                    {{ $orders->location->postCode }},{{ $orders->location->state }}
                </address>
            </div>

            <div class="ml-6">
                <strong>Date and Time</strong><br>
                {{ $orders->orderDate }},<br>
                {{ $orders->orderTime }}
            </div>
        </div>

        <div class="mb-6">
            <strong>Description</strong><br>
            {{ $orders->serviceDescription }}
        </div>

        <div>
            <strong>Price (exclude the insurance)</strong><br>
            RM{{ $orders->price }}
        </div>
           
    </div> 
    @livewireScripts
    <script src="https://kit.fontawesome.com/930fd65046.js" crossorigin="anonymous"></script>
    
</div>