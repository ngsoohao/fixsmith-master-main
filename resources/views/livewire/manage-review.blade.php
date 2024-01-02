<div>
    @livewireStyles
    
    <div>
        @if (session('alert'))
            <div class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">{{ session('alert') }}</span>
            </div>
        @elseif(session('success'))
            <div class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
                <strong class="font-bold">Success</strong>
                <span class="block sm:inline">{{ session('alert') }}</span>
            </div>

        @endif
    
        
        <form wire:submit.prevent="newReview({{$orderID}})" class="max-w-md mx-auto mt-6">
            <h1 class="pb-10 text-lg font-bold">Are you satisfy with the service ?</h1>
            <div class="mb-4">
                <label for="reviewText" class="block mb-2 text-sm font-bold text-gray-700">Review Text:</label>
                <textarea wire:model="reviewText" id="reviewText" rows="4" class="w-full px-3 py-2 border rounded"></textarea>
                @error('reviewText') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
    
            <div class="mb-4">
                <label for="rating" class="block mb-2 text-sm font-bold text-gray-700">Rating:</label>
                <div class="flex">
                    @for ($i = 1; $i <= 5; $i++)
                        <span wire:click="$set('rating', {{$i}})" class="text-3xl cursor-pointer {{ $i <= $rating ? 'text-yellow-500' : 'text-gray-300' }}">&#9733;</span>
                    @endfor
                </div>
                @error('rating') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
    
            <button type="submit" class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400">Submit Review</button>
        </form>
    </div>
    
    @livewireScripts
</div>
