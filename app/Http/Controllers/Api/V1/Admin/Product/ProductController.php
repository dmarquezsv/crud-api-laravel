<?php

namespace App\Http\Controllers\Api\V1\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Added the product model
use App\Models\Product;

class ProductController extends Controller
{   
   // Create a product
    public function createProduct(Request $request)
    {

        //Validate the user data
        $request->validate([
            'sku' => 'required|unique:products',
            'name' => 'required',
            'quantity' => 'required|numeric|integer',
            'price' => 'required|numeric',
            'description' => 'required',
            'img' => 'required',
        ]);

        // Get the id of the logged in user
        $user_id = auth()->user()->id;

        $products = new Product();
        $products->user_id = $user_id;
        $products->sku = $request->sku;
        $products->name = $request->name;
        $products->quantity = $request->quantity;
        $products->price = $request->price;
        $products->description = $request->description;
        $products->img = $request->img;
        $products->save();

        // Return response
        return response()->json([
            "status" => 1,
            "msg" => "¡Producto creado exitosamente!"
        ]);

    }

    // List the products
    public function listProduct()
    {
        $products = Product::all();
        // Devolucion de respuesta
        return response()->json([
            "status" => 1,
            "msg" => "Listado de productos",
            "data" => $products
        ]);
    }

    // Display a product by ID
    public function showProduct($id)
    {
        if (Product::where(["id" => $id])->exists()) {
            $product = Product::find($id);
            // Devolucion de respuesta
            return response()->json([
                "status" => 1,
                "msg" => "Listado de productos",
                "data" => $product
            ]);
        } else {
            // Devolucion de respuesta
            return response()->json([
                "status" => 1,
                "msg" => "Listado de productos",
                "data" => "Producto no encontrado"
            ]);

        }
    }

  
   // Update a product by ID
    public function updateProduct(Request $request, $id)
    {
        if (Product::where(["id" => $id])->exists()) {

            $product = Product::find($id);

            $product->sku = isset($request->sku) ? $request->sku : $product->sku;
            $product->name = isset($request->name) ? $request->name : $product->name;
            $product->quantity = isset($request->quantity) ? $request->quantity : $product->quantity;
            $product->price = isset($request->price) ? $request->price : $product->price;
            $product->description = isset($request->description) ? $request->description : $product->description;
            $product->img = isset($request->img) ? $request->img : $product->img;

          // update the information
            $product->save();

            // Return response
            return response()->json([
                "status" => 1,
                "msg" => "Producto Actualizado ID: " . $id
            ]);

        } else {
           // Return response
            return response()->json([
                "status" => 0,
                "msg" => "No se encontro el ID: " . $id
            ], 404);
        }
    }

    // Delete the product
    public function deleteProduct(Request $request, $id)
    {
        /* 
        If the user exists it is deleted otherwise it returned an error response
        */
        if (Product::where(["id" => $id])->exists()) {

            $user = Product::where(["id" => $id])->first();
            $user->delete();
            return response()->json([
                "status" => 1,
                "msg" => "Producto eliminado ID: " . $id
            ]);
        } {
            // Return response error
            return response()->json([
                "status" => 0,
                "msg" => "No se encontro el ID: " . $id
            ], 404);
        }
    }

}