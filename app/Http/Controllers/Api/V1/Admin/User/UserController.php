<?php

namespace App\Http\Controllers\Api\V1\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Added the user model
use App\Models\User;

// Method to encrypt
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // Register user
    public function register(Request $request)
    {
        //Validate the user data
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric|digits:8',
            #'birthdate' => 'required|date_format:d/m/Y',
            'birthdate' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        //Register the user to the table
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->birthdate = $request->birthdate;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Encryption
        // Save the information
        $user->save();

        // Return response
        return response()->json([
            "status" => 1,
            "msg" => "Usuario creado exitosamente!"
        ]);

    }

    // Show registered users
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

    // Update registered users
    public function updateUser(Request $request, $id)
    {
        /* If the user exists, update it otherwise return an error response */
        if (User::where(["id" => $id])->exists()) {

            $user = User::find($id);
            $user->name = isset($request->name) ? $request->name : $user->name;
            $user->phone = isset($request->phone) ? $request->phone : $user->phone;
            $user->birthdate = isset($request->birthdate) ? $request->birthdate : $user->birthdate;
            $user->username = isset($request->username) ? $request->username : $user->username;
            $user->email = isset($request->email) ? $request->email : $user->email;
            $user->password = isset($request->password) ? Hash::make($request->password) : $user->password; // Incriptación
           // update the information
            $user->save();

            // Return response
            return response()->json([
                "status" => 1,
                "msg" => "Usuario Actualizado ID: " . $id
            ]);

        } else {
            // Return response error
            return response()->json([
                "status" => 0,
                "msg" => "No se encontro el ID: " . $id
            ], 404);
        }
    }

    // Delete a user
    public function deleteUser(Request $request, $id)
    {
       /* If the user exists, delete it otherwise return an error response */
        if (User::where(["id" => $id])->exists()) {

            $user = User::where(["id" => $id])->first();
            $user->delete();
            return response()->json([
                "status" => 1,
                "msg" => "Usuario eliminado ID: " . $id
            ]);
        } {
            // Return response error
            return response()->json([
                "status" => 0,
                "msg" => "No se encontro el ID: " . $id
            ], 404);
        }
    }

    public function login(Request $request)
    {

       // Validate the fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Check if the email entered exists
        $user = User::where("email", "=", $request->email)->first();

        /*
         If the email exists, we proceed to compare the password entered
         Otherwise the username is invalid or the password is incorrect
         */
        if (isset($user->id)) {
            if (Hash::check($request->password, $user->password)) {
               //We create the token that SANCTUM offers us
                $token = $user->createToken("auth_token")->plainTextToken;
                /// If everything is in order, the token is generated
                return response()->json([
                    "status" => 1,
                    "msg" => "¡Usuario logueado existosamte!",
                    "access_token" => $token
                ]);

            } else {
                // Return incorrect password response
                return response()->json([
                    "status" => 0,
                    "msg" => "Correo electrónico o contraseña es incorrecto"
                ], 404);
            }
        } else {
            // Return user response does not exist
            return response()->json([
                "status" => 0,
                "msg" => "Correo electrónico o contraseña es incorrecto"
            ], 404);
        }

    }

    //Authenticated user
    public function userProfile()
    {
        return response()->json([
            "status" => 1,
            "msg" => "Acerca del perfil de usuario",
            "data" => auth()->user() // Mostrar la información del usuario
        ]);
    }

    // Close the session
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