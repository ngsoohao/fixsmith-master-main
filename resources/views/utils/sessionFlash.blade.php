<div x-data="{ showAlert: true }">
    @if (session('alert'))
        <div x-show="showAlert" x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-90"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-90"
             @click="showAlert = false" id="alertMessage" class="relative z-50 w-full px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">{{ session('alert') }}</span>
        </div>
    @elseif(session('success'))
        <div x-show="showAlert" x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-90"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-90"
             @click="showAlert = false" id="alertMessage" class="relative z-50 w-full px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
            <strong class="font-bold">Success</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <script>
        setTimeout(function () {
            document.getElementById('alertMessage').style.display = 'none';
        }, 5000);
    </script>
</div>