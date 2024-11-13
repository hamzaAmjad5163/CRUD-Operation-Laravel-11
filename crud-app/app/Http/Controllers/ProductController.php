<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index() {
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('products.list', [
            'products' => $products
        ]);
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        $rules = [
            'name' => 'required|min:5|max:255',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);

            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('products.edits', [
            'product' => $product
        ]);
    }

    public function update($id, Request $request) {
        $product = Product::findOrFail($id);

        $rules = [
            'name' => 'required|min:5|max:255',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('products.edits', $product->id)->withInput()->withErrors($validator);
        }

        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($product->image) {
                File::delete(public_path('uploads/products/' . $product->image));
            }

            // Save the new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);

            $product->image = $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id) {
        $product = Product::findOrFail($id);

        if ($product->image) {
            File::delete(public_path('uploads/products/' . $product->image));
        }

        $product->delete();
        return redirect()->route('products.index')->with('danger', 'Product deleted successfully');
    }
}
