<div class="py-2 ">
    @livewireStyles

    @if ($claimExistence==false) 
        <section>
            <div class="rounded-lg bg-zinc-200">

                <div class="max-w-2xl mx-auto">

                    <h1 class="text-xl font-bold ">Please Tell Us What Happened</h1>

                    <div class="mt-2">

                        <div class="mb-2">
                            <h2 class="text-md">Title</h2>
                            <input type="text" wire:model='title' class="w-full rounded-md ">
            
                        </div>

                        <div class="mb-2">
                            <h2 class="text-md">Please describe the problem you after encountered.</h2>
                            <textarea wire:model='description' class="w-full rounded-md"></textarea>

                        </div>
                        
                        <div class="mb-2">
                            <h2 class="text-md">When would you like the handymen to come ?</h2>
                            <div>
                                <div class="mb-4">
                                    <label for="date" class="block mb-1">Select a date:</label>
                                    <input type="text" wire:model.lazy="serviceDate" id="datepicker" wire:ignore class="w-full px-4 py-2 border rounded">
                                </div>

                                

                                <div class="mb-4">
                                    <label for="time" class="block mb-1">Select a time:</label>
                                    <select wire:model="serviceTime" id="time" wire:change="checkTimeAvailability" class="w-full px-4 py-2 border rounded">
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
                                 
                            </div>
                        </div>

                        <div class="mb-2">
                            <h2 class="text-md">Could you please provide us photos for references</h2>
                            <input type="file" wire:model="image" class="mt-2">
                            
                            <h2 class="mt-2 text-lg font-bold ">Preview</h2>
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" alt="preview" class="mt-4" width="200" height="200">
                            @endif
                        </div>
                        
                        @include('utils.alert-error')

                        <button class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click="newInsuranceRequest">Submit</button>

                    </div>
                </div>
            </div>
            

        </section>
    
    @else
        
       
            <section class="rounded-lg bg-zinc-200">
                <div class="max-w-2xl mx-auto">
                    @if ($currentState=='requested') 
                    <h1 class="text-xl font-bold ">Claim Request Has Been Submitted</h1>
                    @elseif($currentState=='accepted')
                    <h1 class="text-xl font-bold text-center ">The Insuranced Service Request Has Been Scheduled, <br>Please Wait For Handymen To Come</h1>
                    @elseif($currentState=='declined')
                    <h1 class="text-xl font-bold text-center ">Your Claim Request Has Been Declined, 
                        <br>Please Contact Admin If You Are Not Satisfied With The Result
                    </h1>
                    @endif
    
                
                        <section class="mt-4">
    
                            <div class="mb-4">
                                <h2 class="font-bold text-md">Status</h2>
                                <div class="p-2 bg-white rounded-md ">
                                    {{ $submittedClaim->status }}
                                </div>
                            </div>

                            <div class="mb-4">
                                <h2 class="font-bold text-md">Title</h2>
                                <div class="p-2 bg-white rounded-md ">
                                    {{ $submittedClaim->title }}
                                </div>
                            </div>
    
                            <div class="mb-4">
                                <h2 class="font-bold text-md">Description</h2>
                                <div class="p-2 bg-white rounded-md ">
                                    {{ $submittedClaim->description }}
                                </div>                     
                            </div>
    
                            <div class="mb-4">
                                <h2 class="font-bold text-md">Uploaded Images For References</h2>
                                @if ($imagePath)
                                    
                                    <div class="flex">
                                        @foreach ($imagePath as $imagePaths)
                                        <div class="">
                                            <img src="{{ $imagePaths['imagePath'] }}" alt="Identity Document" width="400" height="400">

                                        </div>
                                        @endforeach
                                    </div>

                                @else
                                    <p class="p-2 bg-white rounded-md">No images were uploaded</p>
                                    <input type="file" wire:model="image" class="mt-2">
                                    <button wire:click='uploadImages({{ $insuranceID }})'>Upload Images</button>
                                
                                    <h2 class="mt-2 text-lg font-bold ">Preview</h2>
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" alt="preview" class="mt-4" width="200" height="200">
                                    @endif
                                    
                                @endif
    
    
                            </div>
                    
                            
                        </section>
                    
                    
                </div>
            </section>
       
    @endif

    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/pikaday.min.js"></script>
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


        document.addEventListener('DOMContentLoaded', () => {
        const scheduleTimeSlotComponent = Livewire.find('schedule-time-slot');

        scheduleTimeSlotComponent.$on('timeSlotChecked', (data) => {
            // Update your UI here based on the data
            console.log(`Day Message: ${data.dayMessage}, Time Message: ${data.timeMessage}`);
            });
        });

        // Check the time slot availability every minute
        setInterval(() => {
        scheduleTimeSlotComponent.call('checkTimeSlotAvailability');
        }, 60 * 1000);

    </script>
</div>