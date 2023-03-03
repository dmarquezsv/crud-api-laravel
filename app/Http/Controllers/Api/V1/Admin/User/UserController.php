<?php

namespace App\Http\Controllers\Api\V1\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Se añadio el modelo de usuario
use App\Models\User;

// Metodo a incriptar 
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // Registrar usuario
    public function register(Request $request)
    {
        //Validar los datos del usuario
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric|digits:8',
            #'birthdate' => 'required|date_format:d/m/Y',
            'birthdate' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        //Registrar el usuario a la tabla
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->birthdate = $request->birthdate;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Incriptación
        // Guardar la información
        $user->save();

        // Devolucion de respuesta
        return response()->json([
            "status" => 1,
            "msg" => "Usuario creado exitosamente!"
        ]);

    }

    // Mostrar los usuarios registrados
    public function listUsers()
    {
        $users = User::all();
        // Devolucion de respuesta
        return response()->json([
            "status" => 1,
            "msg" => "Listado de usuarios",
            "data" => $users
        ]);
    }

    // Actualizar los usuarios registrados
    public function updateUser(Request $request, $id)
    {
        /* 
        Si existe el usuario se actualizaria caso contrario 
        devolvera una respuesta de error
        */
        if (User::where(["id" => $id])->exists()) {

            $user = User::find($id);
            $user->name = isset($request->name) ? $request->name : $user->name;
            $user->phone = isset($request->phone) ? $request->phone : $user->phone;
            $user->birthdate = isset($request->birthdate) ? $request->birthdate : $user->birthdate;
            $user->username = isset($request->username) ? $request->username : $user->username;
            $user->email = isset($request->email) ? $request->email : $user->email;
            $user->password = isset($request->password) ? Hash::make($request->password) : $user->password; // Incriptación
            // actualizar la información
            $user->save();

            // Devolucion de respuesta
            return response()->json([
                "status" => 1,
                "msg" => "Usuario Actualizado ID: " . $id
            ]);

        } else {
            // Devolucion de respuesta error
            return response()->json([
                "status" => 0,
                "msg" => "No se encontro el ID: " . $id
            ], 404);
        }
    }

    // Eliminar un usuario
    public function deleteUser(Request $request, $id)
    {
        /* 
        Si existe el usuario se eliminara caso contrario 
        devolvera una respuesta de error
        */
        if (User::where(["id" => $id])->exists()) {

            $user = User::where(["id" => $id])->first();
            $user->delete();
            return response()->json([
                "status" => 1,
                "msg" => "Usuario eliminado ID: " . $id
            ]);
        } {
            // Devolucion de respuesta error
            return response()->json([
                "status" => 0,
                "msg" => "No se encontro el ID: " . $id
            ], 404);
        }
    }

    public function login(Request $request)
    {

        // Validar los campos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Consultamos si el correo electronico ingresado existe
        $user = User::where("email", "=", $request->email)->first();

        /*
        Si existe el correo electronico procedemos a comparar contraseña ingresada 
        Si no el usuario es invalido o contrasela es incorrecto
        */
        if (isset($user->id)) {
            if (Hash::check($request->password, $user->password)) {
                //Creamos el token que SACTUM nos ofrece
                $token = $user->createToken("auth_token")->plainTextToken;
                // Si todo se encuentra en orden se genera el token
                return response()->json([
                    "status" => 1,
                    "msg" => "¡Usuario logueado existosamte!",
                    "access_token" => $token
                ]);

            } else {
                // Devolucion de respuesta contraseña incorrecto
                return response()->json([
                    "status" => 0,
                    "msg" => "Correo electrónico o contraseña es incorrecto"
                ], 404);
            }
        } else {
            // Devolucion de respuesta del usuario no existe
            return response()->json([
                "status" => 0,
                "msg" => "Correo electrónico o contraseña es incorrecto"
            ], 404);
        }

    }

    //Usuario autenticado
    public function userProfile()
    {
        return response()->json([
            "status" => 1,
            "msg" => "Acerca del perfil de usuario",
            "data" => auth()->user() // Mostrar la información del usuario
        ]);
    }

    // Cerrar la sesión
    public function logout()
    {
        auth()->user()->tokens()->delete(); // Eliminar el token del usuario

        // Devolucion de respuesta de cierre de sision
        return response()->json([
            "status" => 1,
            "msg" => "Cierre de sesión ",
        ]);
    }



}