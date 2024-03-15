<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Validator;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('user')->get();
        $title="All Products";
        return view('showproducts',compact('products','title'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'product_name' => 'required',
            'product_description' => 'required',
            'product_id' => 'required|unique:products',
            'product_category' => 'required',
            'available_quantity' => 'required',
            'enable_display' => 'required',
            'product_price' => 'required',
            'product_img'=>'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $productData['name']=$input['product_name'];
        $productData['detail']=$input['product_description'];
        $productData['product_id']=$input['product_id'];
        $productData['category']=$input['product_category'];
        $productData['quantity']=$input['available_quantity'];
        $productData['display']=$input['enable_display'];
        $productData['price']=$input['product_price'];
        $productData['productimage']=$input['product_img'];
        $productData['user_id']=Auth::user()->id;
        $product = Product::create($productData);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
        return view('showProduct',compact('product'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        if($product->user_id!=Auth::user()->id)
        {
            $right='edit';
            return view('notAuthorized',compact('right'));
        }
        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
        $categories=['Stationary', 'Clothing', 'Electronics', 'Accessories', 'Home appliances'];
        $display=["Yes", "No"];
        return view('editProduct',compact('product','categories'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, Product $product)
    {
        if($product->user_id!=Auth::user()->id)
        {
            $right='update';
            return view('notAuthorized',compact('right'));
        }
        $input = $request->all();

        $validator = Validator::make($input, [
            'product_name' => 'required',
            'product_description' => 'required'
        ]);
        
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        
        $product['name']=$input['product_name'];
        $product['detail']=$input['product_description'];
        $product['category']=$input['product_category'];
        $product['quantity']=$input['available_quantity'];
        $product['display']=$input['enable_display'];
        $product['price']=$input['product_price'];
        $product['productimage']=$input['product_img'];
        $product->save();

        return redirect()->route('products.show',$product->id);
    }


    public function getAllMyProducts(){
        if(Auth::user()){
            $products=[];
            $products = Product::where('user_id',Auth::user()->id)->get();
            $title="My products";
            return view('showproducts',compact('products','title'));
        }
        $right="view";
        return view('notAuthorized',compact('right'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(Product $product)
    {
        if($product->user_id!=Auth::user()->id)
        {
            $right='delete';
            return view('notAuthorized',compact('right'));
        }
        $product->delete();

        return redirect()->route('products.index');
    }

    
    public function deletedProducts(Request $request){
        $products=Product::onlyTrashed()->where('user_id',Auth::user()->id)->get();
        if(count($products)<=0)
        {
            $object='deleted products';
            return view('empty',compact('object'));
        }
        return view('showdeleted',compact('products'));
    }
    public function restoreProduct($id)
    {
        $product = Product::withTrashed()->find($id);
        if($product->user_id!=Auth::user()->id)
        {
            $right='restore';
            return view('notAuthorized',compact('right'));
        }
        $product->restore(); // This restores the soft-deleted post
        return redirect()->route('products.index');
    }

    public function deleteProductForever($id)
    {
       // If you have not deleted before
       $product = Product::withTrashed()->find($id);
       if($product->user_id!=Auth::user()->id)
       {
           $right='delete';
           return view('notAuthorized',compact('right'));
       }

       // If you have soft-deleted it before
       $product = Product::withTrashed()->find($id);

       $product->forceDelete(); // This permanently deletes the post for ever!
       return response()->json(["success"=>true]);
    }

}
