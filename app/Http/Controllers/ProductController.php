<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductFormRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\call;

class ProductController extends Controller
{
    

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

    public function create(Request $request) {
        return view('product.create', [
            'product' => null,
        ]);
    }

    public function store(CreateProductFormRequest $request) {
        
        $data = $request->validated();
        
        /** @var UploadedFile $image */
        $image = $request->validated('image');

        if($image !== null) {
            $data['image'] = $image->store('product', 'public');
        }

        $unprocessed_slug = Str::transliterate(Str::lower($data['name']) . ' ' .  Str::lower($data['description']) . ' ' . time());
        $slug = preg_replace('/[^a-z0-9_-]/', '-', preg_replace('/ /', '_', $unprocessed_slug));
        
        $data['slug'] = $slug;
        
        Product::create($data);

        return redirect()->route('home')
            ->with('product_created', 'Produit crée avec succès');
    }

    public function edit(int $product_id) {

        try {
            return view('product.create', [
                'product' => Product::findOrFail($product_id),
            ]);
        }
        catch(Exception $e) {
            return to_route('home');
        }
    }

    public function update(CreateProductFormRequest $request, int $product_id) {

        $data = $request->validated();
        
        try {
            $product = Product::findOrFail($product_id);
        }
        catch(Exception $e){
            return to_route('homd');
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

        $product->save();
        return redirect()->route('home')
            ->with('product_updated', 'Produit modifié avec succès');
    }
}
