<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Utils\ProductUtil;

class PosProductSearch extends Component
{
    public $term = '';
    public $products = [];
    public $location_id;

    public function mount($location_id)
    {
        $this->location_id = $location_id;
    }

    public function updatedTerm()
    {
        // Only search if term length is at least 2 characters
        if (strlen($this->term) < 2) {
            $this->products = [];
            return;
        }

        // Get products matching the term using your product utility
        $this->products = $this->getProducts($this->term, $this->location_id);

        // If exactly one product is found, auto-select it if allowed
        if (count($this->products) === 1) {
            $product = collect($this->products)->first();

            // Optionally add extra checks similar to your JS code:
            if ($this->canSelectProduct($product)) {
                $this->selectProduct($product->variation_id);
            }
        }
    }

    protected function getProducts($search_term, $location_id)
    {
        $business_id = auth()->user()->business_id;
        $productUtil = app('App\Utils\ProductUtil');

        return $productUtil->filterProduct(
            $business_id,
            $search_term,
            $location_id,
            $not_for_selling = 0,
            $price_group_id = null,
            $product_types = [],
            ['name', 'sku', 'sub_sku'],
            false
        );
    }

    /**
     * Optional: Check if product can be auto-selected.
     * You can add logic here to match your JS conditions (e.g., stock availability, overselling allowed, etc.)
     */
    protected function canSelectProduct($product)
    {
        // Example logic (customize based on your needs):
        if ($product->enable_stock == 1 && $product->qty_available <= 0) {
            return false;
        }
        // Additional checks for overselling or sale type can be added here.
        return true;
    }

    public function selectProduct($variation_id)
    {
      //  \Log::info('Selected variation ID: ' . $variation_id);
        $this->dispatch('productSelected', ['variation_id' => $variation_id]);
        $this->term = '';
        $this->products = [];
    }
    
    public function render()
    {
        return view('livewire.pos-product-search');
    }
}
