<?php

namespace App\Livewire;

use App\Models\MaterialPrice;
use App\Models\Product;
use App\Models\Quote;
use App\Models\QuoteItem;
use Illuminate\View\View;
use Livewire\Component;

class QuoteForm extends Component
{
    public $client_name = '';
    public $email = '';
    public $items = [];

    public $products = [];
    public $materialPrices = [];
    public $quoteTotal = 0;

    public function mount()
    {
        $this->products = Product::where('is_active', true)->get();
        $this->materialPrices = MaterialPrice::with('material')->get();

        $this->addItem(); // Añadir ítem inicial
    }

    public function addItem()
    {
        $this->items[] = [
            'product_id' => '',
            'material_price_id' => '',
            'width' => '',
            'depth' => '',
            'quantity' => 1,
            'warning' => '',
            'unit_price' => 0,
            'total_price' => 0,
        ];

        $this->recalculate();
    }


    public function removeItem($index)
    {
        if (count($this->items) <= 1) {
            return; // No permitir eliminar el último ítem
        }

        unset($this->items[$index]);
        $this->items = array_values($this->items); // Reindexar
        $this->recalculate();
    }


    public function updated($name, $value)
    {
        if (str_starts_with($name, 'items')) {
            $this->recalculate();
        }
    }

    public function recalculate()
    {
        $this->quoteTotal = 0;
        $updatedItems = [];

        foreach ($this->items as $index => $item) {
            if (
                empty($item['material_price_id']) ||
                empty($item['width']) ||
                empty($item['depth']) ||
                empty($item['quantity'])
            ) {
                $item['warning'] = '';
                $item['unit_price'] = 0;
                $item['total_price'] = 0;
                $updatedItems[] = $item;
                continue;
            }

            $material = MaterialPrice::with('material')->find($item['material_price_id']);
            if (!$material) {
                $updatedItems[] = $item;
                continue;
            }

            [$maxWidth, $maxDepth] = explode('x', strtolower($material->format));
            $maxWidth = floatval($maxWidth);
            $maxDepth = floatval($maxDepth);

            $w = floatval($item['width']);
            $d = floatval($item['depth']);

            if ($w > $maxWidth || $d > $maxDepth) {
                $item['warning'] = "⚠️ No cabe en una hoja ({$material->format}cm). Se requerirán cortes adicionales.";
            } else {
                $perRow = floor($maxWidth / $w);
                $perCol = floor($maxDepth / $d);
                $fit = $perRow * $perCol;
                $item['warning'] = "✅ Caben hasta {$fit} piezas por hoja.";
            }

            $m2 = ($w / 100) * ($d / 100);
            $item['unit_price'] = round($m2 * $material->price_per_sqm, 2);
            $item['total_price'] = round($item['unit_price'] * $item['quantity'], 2);

            $this->quoteTotal += $item['total_price'];

            $updatedItems[] = $item;
        }

        $this->items = $updatedItems;
    }

    public function submit()
    {
        $this->validate($this->rules(), $this->messages());

        $quote = Quote::create([
            'client_name' => $this->client_name,
            'email' => $this->email,
            'total' => $this->quoteTotal,
        ]);

        foreach ($this->items as $item) {
            QuoteItem::create([
                'quote_id' => $quote->id,
                'product_id' => $item['product_id'],
                'material_price_id' => $item['material_price_id'],
                'width' => $item['width'],
                'depth' => $item['depth'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['total_price'],
            ]);
        }

        session()->flash('message', '¡Cotización enviada exitosamente!');
        session()->flash('quote_id', $quote->id);
        return redirect()->route('quote.create');
    }

    public function rules()
    {
        return [
            'client_name' => 'required|string|max:255',
            'email' => 'required|email',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.material_price_id' => 'required|exists:material_prices,id',
            'items.*.width' => 'required|numeric|min:1',
            'items.*.depth' => 'required|numeric|min:1',
            'items.*.quantity' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'client_name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo debe ser válido.',
            'items.required' => 'Debe agregar al menos un ítem para cotizar.',
            'items.*.product_id.required' => 'Seleccione un producto.',
            'items.*.product_id.exists' => 'El producto seleccionado no es válido.',
            'items.*.material_price_id.required' => 'Seleccione un material.',
            'items.*.material_price_id.exists' => 'El material seleccionado no es válido.',
            'items.*.width.required' => 'El ancho es obligatorio.',
            'items.*.width.numeric' => 'El ancho debe ser un número.',
            'items.*.width.min' => 'El ancho debe ser mayor que cero.',
            'items.*.depth.required' => 'La profundidad es obligatoria.',
            'items.*.depth.numeric' => 'La profundidad debe ser un número.',
            'items.*.depth.min' => 'La profundidad debe ser mayor que cero.',
            'items.*.quantity.required' => 'Debe ingresar una cantidad.',
            'items.*.quantity.integer' => 'La cantidad debe ser un número entero.',
            'items.*.quantity.min' => 'La cantidad debe ser al menos 1.',
        ];
    }

    public function render(): View
    {
        return view('livewire.quote-form')->layout('layouts.app');
    }
}
