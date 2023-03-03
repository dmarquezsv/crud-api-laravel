<?php

namespace App\Http\Controllers\Api\V1\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Se añadio el modelo productos
use App\Models\Product;

class ProductController extends Controller
{
    public function createProduct(Request $request)
    {

        //Validar los datos del usuario
        $request->validate([
            'sku' => 'required|unique:products',
            'name' => 'required',
            'quantity' => 'required|numeric|integer',
            'price' => 'required|numeric',
            'description' => 'required',
            'img' => 'required',
        ]);

        // Obtener el id del usuario logueado
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

        // Devolucion de respuesta
        return response()->json([
            "status" => 1,
            "msg" => "¡Producto creado exitosamente!"
        ]);

    }

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

    public function searchProduct(Request $request)
    {
        // Consulta para buscar el producto mediante sku o nombre identificando Sensible a mayúsculas y minúsculas
        //$product = Product::where(['sku', 'LIKE', '%' . $request->search . '%'])->get();
        /*
        $product = Product::orWhere([
            "name",
            "like",
             '%' . $request->search . '%'
        ])->get();

        if ($product) {
            // Devolucion de respuesta
            return response()->json([
                "status" => 1,
                "msg" => "Listado de productos",
                "data" => $product
            ]);

        }
        */
    }

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

            // actualizar la información
            $product->save();

            // Devolucion de respuesta
            return response()->json([
                "status" => 1,
                "msg" => "Producto Actualizado ID: " . $id
            ]);

        } else {
            // Devolucion de respuesta error
            return response()->json([
                "status" => 0,
                "msg" => "No se encontro el ID: " . $id
            ], 404);
        }
    }


    public function deleteProduct(Request $request, $id)
    {
        /* 
        Si existe el usuario se eliminara caso contrario 
        devolvera una respuesta de error
        */
        if (Product::where(["id" => $id])->exists()) {

            $user = Product::where(["id" => $id])->first();
            $user->delete();
            return response()->json([
                "status" => 1,
                "msg" => "Producto eliminado ID: " . $id
            ]);
        } {
            // Devolucion de respuesta error
            return response()->json([
                "status" => 0,
                "msg" => "No se encontro el ID: " . $id
            ], 404);
        }
    }

}