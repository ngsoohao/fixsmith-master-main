<div class="overflow-y-auto bg-fixed bg-center bg-slate-400" style="background-image: url('/img/heropic.jpg')">
    @livewireStyles
    <div class="flex items-center justify-center pt-20 pb-10">
        <input class="w-3/5" wire:model="search" type="text" placeholder="Search service types...">
    </div>
    <div class="">
        <div class="flex flex-col lg:flex-row">
            <div class="flex-grow w-full overflow-y-auto lg:w-1/5">
                <div class="mx-auto bg-white rounded-md sm:w-full lg:w-2/3">
                    @foreach ($serviceTypes as $serviceType)
                        <div class="flex items-center justify-center p-2 text-md">
                            <a href="{{route('get-handymen-list',['serviceTypeID'=>$serviceType->serviceTypeID])}}" class="block hover:text-slate-400">
                                {{ $serviceType->serviceTypeName }}
                                <br>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10 mr-10">
                    {{ $serviceTypes->links() }}
                </div>
            </div>

            <div class="w-4/5 mr-10">
                <div>
                    <h1 class="text-3xl font-bold">Popular Services</h1>
                </div>
                <div class="grid gap-4 mt-4 md:grid-cols-2 lg:grid-cols-3 sm:grid-cols-1">
                    <!-- Service 1 -->
                    <div class="p-4 mt-5 bg-white rounded-lg shadow-md">
                        <a href="">
                            <img src="img/aircon.jpg" alt="Service 1" class="object-cover w-full h-48 mb-2">
                            <p class="text-md ">Aircond Services</p>
                        </a>
                    </div>

                    <!-- Service 2 -->
                    <div class="p-4 mt-5 bg-white rounded-lg shadow-md">
                        <a href="">
                            <img src="img/cleaning.webp" alt="Service 2" class="object-cover w-full h-48 mb-2">
                            <p class="text-md">Cleaning</p>
                        </a>
                    </div>

                    <!-- Service 3 -->
                    <div class="p-4 mt-5 bg-white rounded-lg shadow-md">
                        <a href="">
                            <img src="img/furnitureassembly.jpg" alt="Service 3" class="object-cover w-full h-48 mb-2">
                            <p class="text-md ">Furniture Assembly</p>
                        </a>
                    </div>
                    <!-- Service 4 -->
                    <div class="p-4 mt-5 bg-white rounded-lg shadow-md">
                        <a href="">
                            <img src="img/helpmoving.jpg" alt="Service 1" class="object-cover w-full h-48 mb-2">
                            <p class="text-md ">House Moving</p>
                        </a>
                    </div>

                    <!-- Service 5 -->
                    <div class="p-4 mt-5 bg-white rounded-lg shadow-md">
                        <a href="">
                            <img src="img/plumbing.jpeg" alt="Service 2" class="object-cover w-full h-48 mb-2">
                            <p class="text-md ">Plumbing</p>
                        </a>
                    </div>

                    <!-- Service 6 -->
                    <div class="p-4 mt-5 bg-white rounded-lg shadow-md">
                        <a href="">
                            <img src="img/pestcontrol.jpg" alt="Service 3" class="object-cover w-full h-48 mb-2">
                            <p class="text-md ">Pest Control</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
</div>
