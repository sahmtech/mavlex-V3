<?php

namespace Modules\ProductCatalogue\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessLocation;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Models\SellingPriceGroup;
use App\Utils\ModuleUtil;
use App\Utils\ProductUtil;
use App\Utils\BusinessUtil;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductCatalogueController extends Controller
{
    /**
     * All Utils instance.
     */
    protected $productUtil;
    protected $businessUtil;
    protected $moduleUtil;

    /**
     * Constructor
     *
     * @param  ProductUtils  $product
     * @return void
     */
    public function __construct(ProductUtil $productUtil, ModuleUtil $moduleUtil, BusinessUtil $businessUtil)
    {
        $this->productUtil = $productUtil;
        $this->moduleUtil = $moduleUtil;
        $this->businessUtil = $businessUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($business_id, $location_id)
    {
        $business = Business::with(['currency'])->findOrFail($business_id);
        $business_location = BusinessLocation::where('business_id', $business_id)->findOrFail($location_id);
        $hide_out_of_stock = $business_location->hide_out_of_stock_products;
    
        $now = \Carbon::now()->toDateTimeString();
        $discounts = Discount::where('business_id', $business_id)
            ->where('location_id', $location_id)
            ->where('is_active', 1)
            ->where('starts_at', '<=', $now)
            ->where('ends_at', '>=', $now)
            ->orderBy('priority', 'desc')
            ->get();
    
        foreach ($discounts as $key => $value) {
            $discounts[$key]->discount_amount = $this->productUtil->num_f($value->discount_amount, false, $business);
        }
    
        // Eager-load variation_location_details to access qty_available
        $products = Product::where('business_id', $business_id)
                    ->whereHas('product_locations', function ($q) use ($location_id) {
                        $q->where('product_locations.location_id', $location_id);
                    })
                    ->ProductForSales()
                    ->with([
                        'variations', 
                        'variations.product_variation', 
                        'category',
                        'variations.variation_location_details' => function ($q) use ($location_id) {
                            $q->where('location_id', $location_id);
                        }
                    ])
                    ->get()
                    ->groupBy('category_id');
    
        // Calculate variation_qty for each product and filter out of stock if needed
        foreach ($products as $category_id => $product_list) {
            foreach ($product_list as $key => $product) {
                $variation_qty = 0;
                foreach ($product->variations as $variation) {
                    // Sum qty_available for this variation at the current location
                    $variation_qty += $variation->variation_location_details->sum('qty_available');
                }
                // Store the computed qty in the product object
                $product->variation_qty = $variation_qty;
                
                // Remove product if it's out of stock and hide_out_of_stock is enabled
                if ($hide_out_of_stock && $product->enable_stock == 1 && $variation_qty <= 0) {
                    $product_list->forget($key);
                }
            }
            
            // Update the products collection with filtered results
            $products[$category_id] = $product_list;
        }
        
        // Remove empty categories after filtering
        if ($hide_out_of_stock) {
            $products = $products->filter(function ($product_list) {
                return $product_list->count() > 0;
            });
        }
    
        // Get categories in the exact same order as they appear in products
        $categories = collect();
        
        // First, add categories that have products in the exact order they appear
        foreach ($products as $category_id => $product_list) {
            if ($category_id) { // Skip null categories for now
                $category = $product_list->first()->category;
                if ($category) {
                    $categories->put($category_id, $category->name);
                }
            }
        }
        
        // Add uncategorized products at the end if they exist
        if ($products->has(null) || $products->has('')) {
            // Uncategorized will be handled in the view as "Uncategorized"
        }
        $businessUtil = new BusinessUtil();
        $business_details = $businessUtil->getDetails($business_id);
        $currency_details = [
            'symbol' => $business_details->currency_symbol,
            'thousand_separator' => $business_details->thousand_separator,
            'decimal_separator' => $business_details->decimal_separator,
        ];
        return view('productcatalogue::catalogue.index')->with(compact(
            'products', 
            'business', 
            'discounts', 
            'business_location', 
            'categories',
            'currency_details',
            'hide_out_of_stock'
        ));
    }
    
    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($business_id, $id)
    {
        $location_id = request()->input('location_id');
    
        $product = Product::with([
            'brand', 'unit', 'category', 'sub_category', 'product_tax', 
            'variations', 'variations.product_variation', 'variations.group_prices', 
            'variations.media', 'product_locations', 'warranty',
            'variations.variation_location_details' => function ($q) use ($location_id) {
                $q->where('location_id', $location_id);
            }
        ])->where('business_id', $business_id)
          ->findOrFail($id);
    
        // Compute variation_qty for the entire product
        $product_qty = 0;
        foreach ($product->variations as $variation) {
            $v_qty = $variation->variation_location_details->sum('qty_available');
            $product_qty += $v_qty;
    
            // If you also need per-variation quantities:
            $variation->variation_qty = $v_qty;
        }
    
        $product->variation_qty = $product_qty;
    
        // Compute discounts and other details as before
        $price_groups = SellingPriceGroup::where('business_id', $product->business_id)->active()->pluck('name', 'id');
    
        $allowed_group_prices = [];
        foreach ($price_groups as $key => $value) {
            $allowed_group_prices[$key] = $value;
        }
    
        $discounts = [];
        foreach ($product->variations as $variation) {
            foreach ($variation->group_prices as $group_price) {
                $group_price_details[$variation->id][$group_price->price_group_id] = $group_price->price_inc_tax;
            }
            $discounts[$variation->id] = $this->productUtil->getProductDiscount(
                $product, 
                $product->business_id, 
                $location_id, 
                false, 
                null, 
                $variation->id
            );
        }
    
        $combo_variations = [];
        if ($product->type == 'combo') {
            $combo_variations = $this->productUtil->__getComboProductDetails($product->variations[0]->combo_variations, $product->business_id);
        }
        $businessUtil = new BusinessUtil();
        $business_details = $businessUtil->getDetails($business_id);
        $currency_details = [
            'symbol' => $business_details->currency_symbol,
            'thousand_separator' => $business_details->thousand_separator,
            'decimal_separator' => $business_details->decimal_separator,
        ];
    
        return view('productcatalogue::catalogue.show')->with(compact(
            'product',
            'allowed_group_prices',
            'group_price_details',
            'combo_variations',
            'discounts',
            'currency_details'
        ));
    }
    

    public function generateQr()
    {
        $business_id = request()->session()->get('user.business_id');
        if (! (auth()->user()->can('superadmin') || $this->moduleUtil->hasThePermissionInSubscription($business_id, 'productcatalogue_module'))) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');
        $business_locations = BusinessLocation::forDropdown($business_id);
        $business = Business::findOrFail($business_id);

        return view('productcatalogue::catalogue.generate_qr')
                    ->with(compact('business_locations', 'business'));
    }

    public function updateHideOutOfStock(Request $request)
    {
        $request->validate([
            'location_id' => 'required|exists:business_locations,id',
            'hide_out_of_stock' => 'boolean'
        ]);
        
        BusinessLocation::where('id', $request->location_id)
            ->update(['hide_out_of_stock_products' => $request->hide_out_of_stock ?? false]);
        
        return response()->json(['success' => true]);
    }

    public function getLocationSetting($location_id)
    {
        $location = BusinessLocation::findOrFail($location_id);
        
        return response()->json([
            'hide_out_of_stock_products' => $location->hide_out_of_stock_products
        ]);
    }
}
