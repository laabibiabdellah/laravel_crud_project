<?php

namespace App\Http\Controllers;


use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'min:3'],
            'price' => ['required', 'numeric']
        ];

        if ($request->image != '') {
            $rules['image'] = ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'];
        }

        $validator = Validator::make($request->all(), $rules);
        //or => $validator = $request->validate($rules);

        if ($validator->fails()) {
            return to_route('products.create')->withInput()->withErrors($validator);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != '') {

            $img = $request->image;
            $ext = $img->getClientOriginalExtention();
            $imgName = time() . '.' . $ext;

            $img->move(public_path('uploads/products'), $imgName);

            $product->image = $imgName;
            $product->save();
        }
        return to_route('index')->with('success', 'product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $rules = [
            'name' => ['required', 'min:3'],
            'price' => ['required', 'numeric']
        ];

        if ($request->image != '') {
            $rules['image'] = ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'];
        }

        $validator = Validator::make($request->all(), $rules);
        //or => $validator = $request->validate($rules);

        if ($validator->fails()) {
            return to_route('products.edit', $product->id)->withInput()->withErrors($validator);
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->image != '') {
            File::delete(public_path('uploads/products' . $product->image));

            $img = $request->image;
            $ext = $img->getClientOriginalExtention();
            $imgName = time() . '.' . $ext;

            $img->move(public_path('uploads/products'), $imgName);

            $product->image = $imgName;
            $product->save();
        }
        return to_route('index')->with('success', 'product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // File::delete(public_path('uploads/products' . $product->image));

        $product->delete();

        return to_route('index')->with('success', 'product deleted successfully');
    }
}
