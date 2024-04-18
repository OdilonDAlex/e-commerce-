<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryFormRequest;
use App\Http\Requests\CreateProductFormRequest;
use App\Models\Product;
use App\Models\Product\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\call;

class ProductController extends Controller
{
    
    
    public function index() {
        return view('admin.product.index', [
            'products' => Product::paginate(10),
        ]);
    }

    public function show(String $slug, Request $request) {

        $request = $request->validate([
            'product_id' => [
                'required',
                'integer',
                'exists:products,id',
            ]
            ]);
        
        return view('product.show', [
            'product' => Product::find((int)$request['product_id']),
        ]);
        
    }

    public function create() {
        return view('admin.product.create', [
            'product' => null,
            'categories' => Category::pluck('name', 'id'),
        ]);
    }

    public function store(CreateProductFormRequest $request) {
        
        $data = $request->validated();
        $categories_id = null;

        if(array_key_exists('categories_id', $data)){
            $categories_id = array_shift($data);
        }

        /** @var UploadedFile $image */
        $image = $request->validated('image');

        if($image !== null) {
            $data['image'] = $image->store('product', 'public');
        }

        $unprocessed_slug = Str::transliterate(Str::lower($data['name']) . ' ' .  Str::lower($data['description']) . ' ' . time());
        $slug = preg_replace('/[^a-z0-9_-]/', '-', preg_replace('/ /', '_', $unprocessed_slug));
        
        $data['slug'] = $slug;
        
        $product = Product::create($data);

        if ( isset($categories_id) && !empty($categories_id)) {
            $product->categories()->sync($categories_id);
            $product->save(); 
        }
        
        return redirect()->route('admin.product.index')
            ->with('product_created', 'Produit crée avec succès');
    }

    public function edit(int $product_id) {

        try {
            return view('admin.product.create', [
                'product' => Product::findOrFail($product_id),
                'categories' => Category::pluck('name', 'id'),
            ]);
        }
        catch(Exception $e) {
            return to_route('home');
        }
    }

    public function update(CreateProductFormRequest $request, int $product_id) {

        $data = $request->validated();
        $categories_id = null;
        if(array_key_exists('categories_id', $data)){
            $categories_id = array_shift($data);
        }


        try {
            $product = Product::findOrFail($product_id);
        }
        catch(Exception $e){
            return to_route('home');
        }

        /** @var UploadedFile $image */
        $image = $request->validated('image');

        if ( $image === null || $image->getError() ) {
            $product->update($data); 
        }
        else {
            if($product->image){
                Storage::disk('public')->delete($product->image);
            }
    
            $data['image'] = $image->store('product', 'public');
    
            $product->update($data);
        }

        if ( isset($categories_id) && !empty($categories_id)) {
            $product->categories()->sync($categories_id);
            $product->save(); 
        }
        
        return redirect()->route('admin.product.index')
            ->with('product_updated', 'Produit modifié avec succès');
    }

    public function create_category(CreateCategoryFormRequest $request) {
        $original_value = $request['names'];
        $request->validated('names');

        $categories = explode(' ', $original_value); 
        
        foreach($categories as $category){
            Category::create([
                'name' => $category,
            ]);
        }
        
        return redirect()->route('admin.product.index')->with('category_created', 'Categorie créer avec succès');
    }

    public function delete(Request $request){
        $request = $request->validate(
                            [
                'product_id' => [
                    'required',
                    'integer',
                    'exists:products,id'
                    ],
            ] );

        if(Product::destroy((int) $request['product_id']) > 0){
            return redirect()->route('admin.product.index')
                ->with('product_removed', 'Produit supprimé avec succès');
        }
    }
}
