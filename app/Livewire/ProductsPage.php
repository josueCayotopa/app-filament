<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products - Don Bide')]
class ProductsPage extends Component
{
    use WithPagination;
    #[Url]
    public $selected_catefories = [];
    public $selected_brands = [];
    public $featured = [];
    public function render()

    {
        $productquery = Product::query()->where('is_active', 1);
        if (!empty($this->selected_catefories)) {
            $productquery->whereIn('category_id', $this->selected_catefories);
        }
        if (!empty($this->selected_brands)) {
            $productquery->whereIn('brand_id', $this->selected_brands);
        }
        if ($this->featured) {
            $productquery->where('is_featured', 1);
        }

        return view(
            'livewire.products-page',
            [
                'products' => $productquery->paginate(6),
                'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
                'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
            ]
        );
    }
}
