<div class="max-w-6xl mx-auto mt-8 p-6 bg-white rounded shadow">
    @if (session()->has('message'))
        <div class="p-4 bg-green-200 text-green-800 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <h2 class="text-xl font-bold mb-6 text-gray-700">Formulario de cotización</h2>

    <form wire:submit.prevent="submit">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label>Nombre</label>
                <input wire:model="client_name" type="text" class="w-full border rounded p-2">
                @error('client_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label>Email</label>
                <input wire:model="email" type="email" class="w-full border rounded p-2">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <hr class="my-4">

        @foreach ($items as $index => $item)
            <div class="mb-6 border p-4 rounded shadow-sm bg-gray-50">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <div>
                        <label>Producto</label>
                        <select wire:model="items.{{ $index }}.product_id" class="w-full border rounded p-2">
                            <option value="">Seleccionar</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label>Material</label>
                        <select wire:model="items.{{ $index }}.material_price_id"
                            class="w-full border rounded p-2">
                            <option value="">Seleccionar</option>
                            @foreach ($materialPrices as $mp)
                                <option value="{{ $mp->id }}">
                                    {{ $mp->material->name }} - ${{ number_format($mp->price_per_sqm, 2) }} -
                                    {{ $mp->format }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label>Ancho (cm)</label>
                        <input wire:model="items.{{ $index }}.width" type="number"
                            class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label>Profundidad (cm)</label>
                        <input wire:model="items.{{ $index }}.depth" type="number"
                            class="w-full border rounded p-2">
                    </div>
                    <div>
                        <label>Cantidad</label>
                        <input wire:model="items.{{ $index }}.quantity" type="number"
                            class="w-full border rounded p-2">
                    </div>
                </div>

                <div class="text-sm mt-2 text-yellow-600">{!! $item['warning'] !!}</div>
                <div class="mt-1 text-sm text-gray-600">
                    Precio unitario estimado: ${{ number_format($item['unit_price'], 2) }} — Total:
                    ${{ number_format($item['total_price'], 2) }}
                </div>
            </div>
        @endforeach

        <button type="button" wire:click="addItem" class="mb-4 bg-blue-500 text-white px-4 py-2 rounded">
            + Añadir ítem
        </button>

        <div class="mt-4 font-bold text-lg text-gray-700">
            Total estimado: ${{ number_format($quoteTotal, 2) }}
        </div>

        <button type="submit" class="mt-4 bg-green-600 text-white px-6 py-2 rounded">
            Enviar cotización
        </button>
    </form>
</div>
