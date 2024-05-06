<?php

namespace App\Http\Controllers;


use App\Models\Promo;
use App\Http\Requests\Category\CreateCategoryFormRequest;
use App\Http\Requests\CreateProductFormRequest;
use App\Models\Product;
use App\Models\Product\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    
    
    public function index() {


        if(! Gate::allows('visit-admin-pages')) {
            return redirect()->route('home');
        }

        return view('admin.product.index', [
            'query' => null,
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

        if( Gate::allows('visit-admin-pages') ) {
            return view('admin.product.create', [
                'product' => null,
                'categories' => Category::pluck('name', 'id'),
            ]);
        }

        return redirect()->route('home');
    }

    public function store(CreateProductFormRequest $request) {

        if(! Gate::allows('visit-admin-pages') ){
            return redirect()->route('home');
        }

        $data = $this->getValidatedData(['name', 'price', 'stock', 'description'], $request);
        
        $categories_id = $request->validated('categories_id');

        /** @var UploadedFile $image */
        $image = $request->validated('image');

        if($image !== null) {
            $data['image'] = $image->store('product', 'public');
        }

        $unprocessed_slug = Str::transliterate(Str::lower($data['name']) . ' ' .  Str::lower($data['description']) . ' ' . time());
        $slug = preg_replace('/[^a-z0-9_-]/', '-', preg_replace('/ /', '_', $unprocessed_slug));
        
        $data['slug'] = $slug;
        
        $product = Product::create($data);

        $promo_value = $request->validated('promo');
        $promo_expired_date = $request->validated('promo_expired_date');

        if(($promo_expired_date !== null) && (($promo_value !== null) && ($promo_value > 0) )){
            $promo = Promo::create([
                'value' => $promo_value,
                'end_at' => new Carbon($promo_expired_date)
            ]);

            $product->promos()->associate($promo) ;
        }

        if ( isset($categories_id) && !empty($categories_id)) {
            $product->categories()->sync($categories_id);
            $product->save(); 
        }
        
        return redirect()->route('admin.product.index')
            ->with('product_created', 'Produit crée avec succès');
    }

    public function edit(int $product_id) {
        if(! Gate::allows('visit-admin-pages') ) {
            return redirect()->route('home');
        }


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

        if(! Gate::allows('visit-admin-pages')) {
            return redirect()->route('home');
        }

        $data = $this->getValidatedData(['name', 'price', 'stock', 'description'], $request);
        
        $categories_id = $request->validated('categories_id');

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
            if($product->image != 'product-default-image.jpg'){
                Storage::disk('public')->delete($product->image);
            }
    
            $data['image'] = $image->store('product', 'public');
    
            $product->update($data);
        }

        if ( isset($categories_id) && !empty($categories_id)) {
            $product->categories()->sync($categories_id);
            $product->save(); 
        }
        
        $remove_promo = $request->validated('remove_promo') ;

        if($remove_promo !== null){
            $old_promo = $product->promos()->first();
            
            $product->promos()->dissociate();
            Promo::destroy($old_promo->id);
        }
        else {
            $promo_value = $request->validated('promo');
            $promo_expired_date = $request->validated('promo_expired_date');


            if(($promo_expired_date !== null) && (($promo_value !== null) && ($promo_value > 0) )){
                
                
                if(! $product->promos()->get()->isEmpty()) {

                    $old_promo = $product->promos()->first(); ;
                    $old_promo->update([
                        'value' => $promo_value,
                        'end_at' => $promo_expired_date
                    ]) ;

                    $old_promo->save();
                }
                else {
                    $promo = Promo::create([
                        'value' => $promo_value,
                        'end_at' => new Carbon($promo_expired_date)
                    ]);
                    $product->promos()->associate($promo) ;
                }


                $product->save();
            }
        }

        return redirect()->route('admin.product.index')
            ->with('product_updated', 'Produit modifié avec succès');
    }

    public function getValidatedData($keys, $request) {
        $data = array() ;

        foreach($keys as $key){
            $value = $request->validated($key);

            if($value !== null){
                $data[$key] = $request->validated($key);
            }
        }

        return $data;
    }

    public function create_category(CreateCategoryFormRequest $request) {
        if(! Gate::allows('visit-admin-pages')) {
            return redirect()->route('home');
        }

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

        if(! Gate::allows('visit-admin-pages')) {
            return redirect()->route('home');
        }
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

    public function search(Request $request) {

        $request = $request->validate([
            'route' => ['required', 'string', 'regex:/(search\.home|admin\.product\.index)|product\.index/'],
            'query' => ['required', 'string', 'regex:/.+/'],
        ]); 

        $findedProductByName = Product::whereRaw("name REGEXP '.*".  $request['query'] . ".*'")->get();
        $findedCategories = Category::whereRaw("name REGEXP '.*" . $request['query'] . ".*'")->get();

        return view($request['route'], [
            'query' => $request['query'],
            'products' => $findedProductByName,
            'categories' => $findedCategories,
        ]);
    }
    
    public function productIndex() {
        return view('product.index', [
            'query' => null,
            'products' => Product::orderBy('name')->paginate(25),
        ]) ;
    }
}
