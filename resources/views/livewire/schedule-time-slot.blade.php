<div>
    <section>
        <label for="specificTime">Specific Time:</label>
        <input type="text" wire:model="specificTime" id="specificTime" placeholder="Enter time">

        <button wire:click="checkTimeSlotAvailability">Check Availability</button>

        @if($isTimeSlotAvailable)
            <p>Time slot is available.</p>
        @else
            <p>Time slot is not available.</p>
        @endif
    </section>
    
</div>