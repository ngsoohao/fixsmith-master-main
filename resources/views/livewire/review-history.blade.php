
<div class="min-h-screen sm:block md:flex">
    @livewireStyles
    <div class="flex-shrink-0 md:mr-5 md:border-r-2 w-1/7 md:border-slate-500">
        @include("nav.side-nav")        
    </div>
    
    <div class="overflow-x-auto w-6/7">
        <h1 class="mb-4 text-xl font-bold">My Reviews</h1>
        @foreach ($reviews as $review)
            <div class="flex justify-center p-3 mr-3 ">
                <div class="w-screen p-2 pb-2 mr-2 rounded-md shadow-md bg-slate-300">
                    <div class="flex">
                        <img src="{{ $review->serviceProvider->user->profile_photo_url }}" alt="Profile Picture" class="w-40 h-40 rounded-full">
                    
                        <div class="flex ml-5">
                            <div class="mr-5">
                                <strong>Serviced By:</strong><br>
                                {{$review->serviceProvider->user->name}}
                            </div>
                            <div class="mr-5">
                                <strong>In Order:</strong><br>
                                {{$review->orderID}}
                            </div>
                            
                            
                            @if ($editMode[$review->reviewID] == true)
                                <div class="mb-4">
                                    <label for="rating" class="block mb-2 text-sm font-bold text-gray-700">Rating:</label>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button class="mx-1 text-2xl" wire:click="setRating({{ $i }})">
                                            @if ($i <= $rating)
                                                <i class="text-yellow-500 fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        </button>
                                    @endfor
                                    <textarea wire:model="reviewText.{{ $review->reviewID }}" class="w-full px-3 py-2 border rounded"></textarea>
                                </div>
                                <div class="mt-3">
                                    <button class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click="saveReview({{$review->reviewID}})">Save</button>
                                    <button class="px-4 py-2 text-white rounded-md bg-slate-700 hover:bg-slate-400" wire:click="cancelEdit({{$review->reviewID}})">Cancel</button>
                                </div>
                            @else
                                <div class="flex flex-row">
                                    <div class="w-2/10">
                                        <strong>Rating:</strong><br>
                                        <div class="stars" data-rating="{{$review->rating}}"></div>
                                    </div>
                                    <div class="px-5 w-6/10">
                                        <strong>Review:</strong>
                                        <div>
                                            {{$review->reviewText}}
                                        </div>
                                    </div>
                                    <div class="absolute mt-3 right-10 w-2/10">
                                        <button class="px-4 py-2 text-white rounded-md bg-slate-600 hover:bg-slate-400" wire:click="enterEditMode({{$review->reviewID}})">Edit</button>
                                        <button class="px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-400" onclick="showConfirmation()">Delete</button>

                                    </div>

                                </div>
                                    
                            @endif
                        </div>
                    </div>
                    

                </div>
            </div>

            <!--The hidden confirmation before delete-->
            <div id="confirmationDialog" class="fixed inset-0 hidden overflow-y-auto">
                <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                    <!-- Heroicon name: exclamation -->
                                    <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c.54 0 1.063-.2 1.466-.564.402-.363.628-.852.628-1.36V11.36c0-.51-.226-.999-.628-1.363a1.933 
                                        1.933 0 0 0-1.466-.563H6.465A1.95 1.95 0 0 0 5 9.36V19a2 2 0 0 0 2 2zm-2-6l6-6 6 6"></path>
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                                        Delete Confirmation
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                            Are you sure you want to delete this location?
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                            <!-- Add a click event to perform the delete action -->
                            <button wire:click="deleteReview({{$review->reviewID}})" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                                Delete
                            </button>
                            <button onclick="hideConfirmation()" type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-200 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
                
        @endforeach

        
    </div>
    <!-- Add Font Awesome for star icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script>
        function showConfirmation() {
            document.getElementById('confirmationDialog').classList.remove('hidden');
        }

        function hideConfirmation() {
            document.getElementById('confirmationDialog').classList.add('hidden');
        }

        function createStarRating(container, rating) {
            const starsDiv = document.createElement('div');
            starsDiv.classList.add('stars');

            // Create 5 empty stars
            const emptyStars = '<i class="text-yellow-500 far fa-star"></i>'.repeat(5);
            starsDiv.innerHTML = emptyStars;

            // Add filled stars based on the rating
            const filledStars = '<i class="text-yellow-500 fas fa-star"></i>'.repeat(Math.round(rating));
            starsDiv.innerHTML = filledStars + emptyStars.substring(filledStars.length);

            container.appendChild(starsDiv);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const starContainers = document.querySelectorAll('.stars');

            starContainers.forEach(container => {
                const rating = parseFloat(container.dataset.rating);
                createStarRating(container, rating);
            });
        });
    </script>

    
@livewireScripts
</div>
