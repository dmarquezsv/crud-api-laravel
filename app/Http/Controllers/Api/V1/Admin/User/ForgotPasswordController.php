<?php

namespace App\Http\Controllers\Api\V1\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Add the following modules
use DB;
use Illuminate\Support\Str;
// added time
use Carbon\Carbon;
// Se añadio el modelo de usuario
use App\Models\User;
// Added the user model
use Illuminate\Support\Facades\Mail;

// Method to encrypt
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    //
    public function forgetPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);

        //Check if the email exists
        if (User::where(["email" => $request->email])->exists()) {

            $token = Str::random(64); // We generate a token

            // Register the token to the password_resets table
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            /*
           If the user exists, they must send an email to reset the password
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

            // Return response error
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
       We check if the generated email and token are in the password resets tables before making the password change.
        */
        $token = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        /* 
       If the token does not exist, it will not be able to perform the action
         to change the password.
        */
        if (!$token) {
            return response()->json([
                "status" => 0,
                "msg" => "Inválido token"
            ], 404);
        } else {

           //If the token exists, we check if it is still available, since the duration is 15 minutes
            $date_current_time = Carbon::now(); // Get the current date and time

            //Get the time elapsed since the token was created
            $time_elapsed = $date_current_time->diff($token->created_at)->format("%H:%i:%s");

            // Token life 15 minutes
            if ($time_elapsed <= "00:15:00") {

                //Update the user's password
                User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

                //We remove the generated token associated with the mail
                DB::table('password_resets')->where(['email' => $request->email])->delete();

                return response()->json([
                    "status" => 1,
                    "msg" => "¡Tu contraseña ha sido cambiada!",
                ]);

            } else {
                // Return response error
                return response()->json([
                    "status" => 0,
                    "created_at" => $time_elapsed,
                    "msg" => "¡Token expirado!"
                ]);
            }
        }
    }


}