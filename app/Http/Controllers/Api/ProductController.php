<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Product\Category;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index(){
        return ProductResource::collection(Product::paginate(25));
    }

    public function show(int|string $id) {

        try {
            if($id !== null && (int) $id > 0){
                return new ProductResource(Product::find((int) $id));
            }
            throw new Exception('error');
        }
        catch(Exception $error){
            return json_encode(['result' => 'Product Not Found']);
        }
    } 

    public function byCategory(int|string $category) {
        try {
            if(is_numeric($category)){
                $category = Category::find((int) $category);
                return ProductResource::collection($category->products()->get());
            }

            $categories_id = Category::select('id')
                ->whereRaw("name REGEXP '.*" . $category . ".*'")
                ->get()
                ->pluck('id')
                ->toArray();

            $products_id = DB::table('category_product')
                ->select('product_id')
                ->whereRaw('category_id IN (' . implode(', ', $categories_id) . ')')
                ->get()
                ->pluck('product_id')
                ->toArray();

            return ProductResource::collection(Product::whereRaw('id IN (' . implode(', ', $products_id) . ')')
                ->get());
        }
        catch(Exception $e) {
            return json_encode(['result' => 'empty']);
        }   
    }
}
