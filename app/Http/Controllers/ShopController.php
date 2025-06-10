<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {     
        $size = $request->query('size') ? $request->query('size') : 12;
        $o_column = "";
        $o_order = "";
        $order = $request->query('order') ? $request->query('order') : -1;
        $f_brands = $request->query('brands');
        $f_categories = $request->query('categories');
       $min_price = $request->query('min') ? $request->query('min') : 1;
       $max_price = $request->query('max') ? $request->query('max') : 500;
        
        switch($order)
        {
          case 1:
                $o_column= 'created_at';
                $order = 'DESC';
                break;
           case 2:
             $o_column= 'created_at';
              $order = 'ASC';
              break;
           case 3:
              $o_column= 'sale_price';
                $order = 'ASC';
                break;
           case 4:
              $o_column= 'sale_price';
               $order = 'DESC';
              break;

           default:
             $o_column= 'id';
             $o_order ='DESC';
        }
        $brands = Brand::orderby('name','ASC')->get();
        $categories = Category::orderby('name','ASC')->get();

        //brands shows in shop
        $products = Product::where(function($query) use($f_brands){
             $query->whereIn('brand_id', explode(',',$f_brands))->orWhereRaw("'".$f_brands."'=''");
        })
        //categry shows in shop
        ->where(function($query) use($f_categories){
          $query->whereIn('category_id', explode(',',$f_categories))->orWhereRaw("'".$f_categories."'=''");
     })
     //price increase and price decrease
     ->where(function($query) use($min_price, $max_price){
       $query->whereBetween('regular_price', [$min_price,$max_price])
       ->orwhereBetween('sale_price', [$min_price,$max_price]);
     })
                    ->orderby($o_column,$o_order)->paginate($size);
        return view('shop',compact('products','size', 'order','brands', 'f_brands' , 'categories','f_categories', 'min_price', 'max_price'));
    }
      // product_details show  in this method
    public function product_details($product_slug)
    {
        $product = Product::where('slug',$product_slug)->first();
        $rproducts = Product::where('slug','<>',$product_slug)->get()->take(8);
        return view('details',compact('product','rproducts'));
    }
}
