<div>
    @livewire('navbar')

    {{-- TITULO PRINCIPAL --}}
    <div class="text-center mt-12 px-4">
        <h1 class="text-4xl font-bold text-gray-800 mb-2">Cotizar Mueble</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">
            Indícanos cada detalle de tu mueble para darte una cotización más precisa y conveniente de nuestra Red.
        </p>
    </div>

    {{-- ICONOS DE BENEFICIOS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center mb-16 mt-12 px-4">
        <div class="flex flex-col items-center">
            <div class="bg-green-100 rounded-full p-4 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2l4 -4M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2S2 6.477 2 12s4.477 10 10 10z" />
                </svg>
            </div>
            <h3 class="font-semibold text-lg text-gray-700">Cómodo y sencillo</h3>
        </div>

        <div class="flex flex-col items-center">
            <div class="bg-blue-100 rounded-full p-4 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 12l5 5l5 -5M12 7v10" />
                </svg>
            </div>
            <h3 class="font-semibold text-lg text-gray-700">Tu mejor propuesta</h3>
        </div>

        <div class="flex flex-col items-center">
            <div class="bg-yellow-100 rounded-full p-4 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-yellow-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 12v-2a8 8 0 0116 0v2M4 15v1a3 3 0 003 3h10a3 3 0 003-3v-1" />
                </svg>
            </div>
            <h3 class="font-semibold text-lg text-gray-700">Atención 24/7</h3>
        </div>
    </div>

    {{-- FORMULARIO DE COTIZACIÓN --}}
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            {{-- Imagen lateral --}}
            <div class="w-full h-full">
                <img class="rounded-lg shadow-lg object-cover w-full h-full"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCONp4lyBOQW8yJZH4wBJOShzDe2LyCROX-cOL2CugAr7dcgtTqRH2uYwAHR1gfpHepCiVh6v-oyT1jx0yVPotuuG0vyoQU6b_Cx1P67hPYo4pWnz9E9IUxJqgxEfoJlPkdLNXXoLj5n5r6EDWU1kA-ddNa8n6inLwCkWI-8aye2A5bAhcLd6g7_cIpKeiEgQIMZzj1y3jE07DC7uyzG28Q6iehWq5--uxLFOVCQbDssg46MrrgyPOPw6u_a_VSs0ruX3KuWW6IDHU" />
            </div>

            {{-- Formulario Livewire --}}
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Cotiza Online!</h2>

                @if (session('quote_id'))
                    <div class="flex flex-wrap items-center gap-3">
                        {{-- Botón PDF --}}
                        <a href="{{ route('quote.download', ['quote' => session('quote_id')]) }}"
                            class="inline-flex items-center justify-center gap-2 bg-[#1A5275] text-white px-4 py-2 rounded-full hover:bg-[#154360] transition shadow w-fit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Descargar PDF
                        </a>

                        {{-- Botón WhatsApp --}}
                        <a href="https://wa.me/message/UW5TVB5SSVAAO1" target="_blank"
                            class="inline-flex items-center justify-center gap-2 bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition shadow w-fit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M20.52 3.48A11.91 11.91 0 0 0 12 0C5.37 0 .02 5.35 0 11.97a11.94 11.94 0 0 0 1.62 6.01L0 24l6.21-1.62A11.95 11.95 0 0 0 12 24c6.63 0 12-5.37 12-12a11.9 11.9 0 0 0-3.48-8.52zM12 21.5c-1.88 0-3.74-.5-5.38-1.46l-.38-.22-3.69.97.98-3.6-.25-.38A9.49 9.49 0 0 1 2.5 12C2.5 6.76 6.76 2.5 12 2.5S21.5 6.76 21.5 12 17.24 21.5 12 21.5zm5.4-7.61c-.29-.15-1.71-.84-1.98-.94-.27-.1-.47-.15-.67.15s-.77.94-.95 1.13-.35.22-.64.07a7.7 7.7 0 0 1-2.26-1.39 8.51 8.51 0 0 1-1.57-1.95c-.16-.27-.02-.42.12-.56.12-.12.27-.3.4-.45.14-.15.18-.26.27-.43.09-.18.05-.33-.02-.46s-.67-1.61-.91-2.2c-.24-.58-.48-.5-.67-.5h-.57c-.18 0-.46.06-.7.33s-.92.9-.92 2.18c0 1.29.95 2.53 1.08 2.7.13.18 1.87 2.86 4.52 4.01.63.27 1.13.43 1.51.55.64.2 1.22.17 1.68.1.51-.08 1.71-.7 1.95-1.37.24-.68.24-1.27.17-1.37-.06-.1-.25-.16-.54-.3z" />
                            </svg>
                            Prueba tu mueble con IA
                        </a>
                    </div>
                @endif
                <form wire:submit.prevent="submit" class="space-y-6">
                    {{-- Datos del cliente --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Nombre <span class="text-red-500">*</span>
                            </label>
                            <input wire:model="client_name" type="text"
                                class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-500">
                            @error('client_name')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input wire:model="email" type="email"
                                class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-500">
                            @error('email')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Ítems dinámicos --}}
                    @foreach ($items as $index => $item)
                        <div class="border border-gray-200 p-4 rounded-lg bg-white shadow-sm space-y-3">
                            <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
                                {{-- Producto --}}
                                <div class="flex flex-col">
                                    <label class="text-xs text-gray-600 font-medium mb-1">Producto <span
                                            class="text-red-500">*</span></label>
                                    <select wire:model="items.{{ $index }}.product_id"
                                        class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-500">
                                        <option value="">Selecciona</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error("items.$index.product_id")
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Material --}}
                                <div class="flex flex-col">
                                    <label class="text-xs text-gray-600 font-medium mb-1">Material <span
                                            class="text-red-500">*</span></label>
                                    <select wire:model="items.{{ $index }}.material_price_id"
                                        class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-500">
                                        <option value="">Selecciona</option>
                                        @foreach ($materialPrices as $mp)
                                            <option value="{{ $mp->id }}">
                                                {{ $mp->material->name }} -
                                                ${{ number_format($mp->price_per_sqm, 2) }}
                                                - {{ $mp->format }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error("items.$index.material_price_id")
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Ancho --}}
                                <div class="flex flex-col">
                                    <label class="text-xs text-gray-600 font-medium mb-1">Ancho (cm) <span
                                            class="text-red-500">*</span></label>
                                    <input wire:model="items.{{ $index }}.width" type="number"
                                        class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-500">
                                    @error("items.$index.width")
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Profundidad --}}
                                <div class="flex flex-col">
                                    <label class="text-xs text-gray-600 font-medium mb-1">Profundidad (cm) <span
                                            class="text-red-500">*</span></label>
                                    <input wire:model="items.{{ $index }}.depth" type="number"
                                        class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-500">
                                    @error("items.$index.depth")
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Cantidad --}}
                                <div class="flex flex-col">
                                    <label class="text-xs text-gray-600 font-medium mb-1">Cantidad <span
                                            class="text-red-500">*</span></label>
                                    <input wire:model="items.{{ $index }}.quantity" type="number"
                                        class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-500">
                                    @error("items.$index.quantity")
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="text-xs text-gray-600">{!! $item['warning'] !!}</div>
                            <div class="text-sm text-gray-700 font-medium">
                                Precio unitario: <strong>${{ number_format($item['unit_price'], 2) }}</strong> — Total:
                                <strong>${{ number_format($item['total_price'], 2) }}</strong>
                            </div>
                            {{-- Botón eliminar ítem --}}
                            <div class="flex justify-end">
                                <button type="button" wire:click="removeItem({{ $index }})"
                                    class="inline-flex items-center text-red-500 hover:text-red-700 text-sm transition duration-150 ease-in-out">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                        </path>
                                    </svg>
                                    Eliminar
                                </button>
                            </div>

                        </div>
                    @endforeach

                    {{-- Botón Añadir Ítem --}}
                    <button type="button" wire:click="addItem"
                        class="inline-flex items-center gap-2 bg-[#1A5275] text-white px-4 py-2 rounded-full hover:bg-[#154360] transition shadow-sm hover:shadow-md focus:outline-none focus:ring focus:ring-blue-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Añadir ítem
                    </button>

                    {{-- Total --}}
                    <div class="font-bold text-lg text-gray-700 mt-2">
                        Total estimado: ${{ number_format($quoteTotal, 2) }}
                    </div>

                    {{-- Enviar --}}
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 py-3 px-6 bg-green-600 text-white font-semibold rounded-full hover:bg-green-700 transition-all duration-200 shadow hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 16l2-2m0 0l6-6m-6 6v6m-2-6h6" />
                        </svg>
                        Enviar cotización
                    </button>
                </form>

                <div class="mt-6 text-sm text-gray-500">
                    <p>(*) Rellena todos los campos para recibir una cotización precisa.</p>
                    <p class="mt-2">Puedes agregar varios productos en una sola cotización.</p>
                </div>
            </div>
        </div>
    </div>
</div>
