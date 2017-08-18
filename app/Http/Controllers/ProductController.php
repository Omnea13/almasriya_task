<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use Helper;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();

        return response()->json($products, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->categories = $request->categories;
        if ($request->image) {
            $product->image = Helper::uploadImage('image', 'products');
        }
        $product->save();

        return response()->json($product, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        
        if (!$product){
            return response()->json(["error" => "No such a product!"], 404);
        }
        
        return response()->json($product, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        if (!$product){
            return response()->json(["error" => "No such a product!"], 404);
        }
        
        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product){
            return response()->json(["error" => "No such a product!"], 404);
        }
        $product->title = $request->title;
        $product->categories = $request->categories;
        if ($request->photo) {
            $product->photo = Helper::uploadImage('photo', 'products');
        }
        $product->save();

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product){
            return response()->json(["error" => "No such a product!"], 404);
        }

        $product->delete();

        return response()->json($product, 200);
    }
}
