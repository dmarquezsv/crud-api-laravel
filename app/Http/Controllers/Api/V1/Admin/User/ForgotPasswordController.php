<?php

namespace App\Http\Controllers\Api\V1\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Se añade los siguientes modulos
use DB;
use Illuminate\Support\Str;
// Se añadio el tiempo
use Carbon\Carbon;
// Se añadio el modelo de usuario
use App\Models\User;
// Se añadio el modulo envio de correo
use Illuminate\Support\Facades\Mail;

// Metodo a incriptar 
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    //
    public function forgetPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);

        //Verificar si el correo electronico existe
        if (User::where(["email" => $request->email])->exists()) {

            $token = Str::random(64); // Generamos un token

            // Registramos el token a la tabla password_resets
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            /*
            Si existe el usuario debera enviar un correo electronico para reseteo de la contraseña
            */
            $data = ['email' => $request['email'], 'token' => $token];
            $user['to'] = $request['email'];
            Mail::send("mail.template", $data, function ($messages) use ($user) {
                $messages->to($user['to']);
                $messages->subject('Restablecer la contraseña');
            });

            return response()->json([
                "status" => 1,
                "token" => $token,
                "msg" => "¡Le hemos enviado por correo electrónico su enlace de restablecimiento de contraseña!"
            ]);

        } else {

            // Devolucion de respuesta error
            return response()->json([
                "status" => 0,
                "msg" => "El correo electrónico no se encuentra registrado"
            ], 404);
        }
    }

    public function resetPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        /*
        Verificamos si el correo electronico y token generado se encuentre en la tablas password resets
        ante de realizar el cambio de contraseña.
        */
        $token = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        /* 
        Si no existe el token no podra realizar la acción
        de cambiar la contraseña.
        */
        if (!$token) {
            return response()->json([
                "status" => 0,
                "msg" => "Inválido token"
            ], 404);
        } else {

            //Si existe el token verificamos si aún sigue disponible, ya que la duración es de 15 minutos
            $date_current_time = Carbon::now(); //Obtener la fecha y  la hora actual

            //Obtener el tiempo transcurrido al haber creado el token
            $time_elapsed = $date_current_time->diff($token->created_at)->format("%H:%i:%s");

            // Vida del token 15 minutos
            if ($time_elapsed <= "00:15:00") {

                //Actualizamos la contraseña del usuario
                User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

                //Eliminamos el token generado asociado con el correo
                DB::table('password_resets')->where(['email' => $request->email])->delete();

                return response()->json([
                    "status" => 1,
                    "msg" => "¡Tu contraseña ha sido cambiada!",
                ]);

            } else {
                // Devolucion de respuesta error
                return response()->json([
                    "status" => 0,
                    "created_at" => $time_elapsed,
                    "msg" => "¡Token expirado!"
                ]);
            }
        }
    }


}