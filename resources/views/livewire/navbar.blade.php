<div class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        {{-- Logo --}}
        <div class="flex items-center">
            <img src="{{ asset('img/trans.png') }}" alt="Mi logo" class="h-16 mr-3">
        </div>

        {{-- Botón hamburguesa --}}
        <button wire:click="toggleMenu" class="md:hidden text-[#1A5275] focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        {{-- Menú en desktop --}}
        <nav class="hidden md:flex items-center space-x-6 text-sm font-medium text-gray-700">

            <a href="#" class="text-[#1A5275] border-b-2 border-[#1A5275] pb-1">COTIZAR MUEBLE</a>

        </nav>
    </div>

    {{-- Menú en móviles --}}
    @if ($isOpen)
        <div class="md:hidden px-4 pb-4 space-y-2 text-sm font-medium text-gray-700">

            <a href="#" class="block text-[#1A5275] border-l-4 border-[#1A5275] pl-2">COTIZAR MUEBLE</a>

        </div>
    @endif
</div>
