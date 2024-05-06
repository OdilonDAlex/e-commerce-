<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Product\Category;
use Exception;

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

    public function byCategory(int|string $category_id) {
        try {
            $category = Category::find((int) $category_id);
            return ProductResource::collection($category->products()->get());
        }
        catch(Exception $e) {
            return json_encode(['result' => 'empty']);
        }   
    }
}
