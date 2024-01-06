<div class="container py-2 ">
    @livewireStyles
    
        <div class="rounded-lg bg-zinc-200">
        
        <form wire:submit.prevent="newOrder" class="max-w-md mx-auto">
            <h1 class="mb-5 text-xl font-bold">Please insert your Details</h1>
            <>
                <label for="location">Choose a location:</label>
                <select wire:model="selectedLocationID" id="location" class="w-full px-4 py-2 border rounded">
                    <option value="">Select an address</option>
                    @foreach ($userLocations as $location)
                        <option value="{{ $location->locationID }}">
                            {{ $location->unitNo }},
                            {{ $location->street }},
                            {{ $location->city }},
                            {{ $location->postCode }}
                            {{ $location->state }}
                        </option>
                    @endforeach
                </select>
        
                <div class="mb-4">
                    <label for="date" class="block mb-1">Select a date:</label>
                    <input type="text" wire:model.lazy="orderDate" id="datepicker" wire:ignore class="w-full px-4 py-2 border rounded">
                </div>

                

                <div class="mb-4">
                    <label for="time" class="block mb-1">Select a time:</label>
                    <select wire:model="orderTime" id="time" wire:change="checkTimeAvailability" class="w-full px-4 py-2 border rounded">
                        <option  value="10:00:00">10:00 AM</option>
                        <option  value="11:00:00">11:00 AM</option>
                        <option  value="12:00:00">12:00 PM</option>
                        <option  value="13:00:00">1:00 PM</option>
                        <option  value="14:00:00">2:00 PM</option>
                        <option  value="15:00:00">3:00 PM</option>
                        <option  value="16:00:00">4:00 PM</option>
                        <option  value="17:00:00">5:00 PM</option>
                    </select>
                </div>

                <div class="mb-4">

                    @if($message)
                    <p class="font-bold text-red-700">This time is not available.</p>
                    @else
                    <p class="font-bold text-green-700">This time is available.</p>
                    @endif 
                </div>
                
        
                <div class="mb-4">
                    <label for="serviceDetail" class="block mb-1">Service details</label>
                    <textarea wire:model="serviceDescription" wire:ignore placeholder="Please describe the issue and service needed" class="w-full px-4 py-2 border rounded"></textarea>
                </div>

                
        
                <div class="flex items-center justify-between">
                    <button class="px-4 py-2 text-white rounded-md bg-slate-600 hover:bg-slate-400 text-md" type="submit">Make Booking</button>
                </div>
            </div>
        </form>

        

        

    </div>
    

    
    @livewireScripts

        <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/pikaday.min.js"></script>
        <script src="pikaday.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
              var picker = new Pikaday({
                field: document.getElementById('datepicker'),
                format: 'DD/M/YYYY',
                toString(date, format) {
                  // Format the date with month as a string
                  const day = date.getDate();
                  const month = moment(date).format('MMMM'); // Full month name
                  const year = date.getFullYear();
                  return `${day} ${month} ${year}`;
                },
                parse(dateString, format) {
                  // Parse the formatted string using moment.js
                  return moment(dateString, 'D MMMM YYYY').toDate();
                }
              });
            });
        </script>
</div>