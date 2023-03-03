<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Developer Backend</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style type="text/css">
        a[x-apple-data-detectors] {
            color: inherit !important;
        }
    </style>
</head>

<body style="margin: 0; padding: 0;">
    
    <p style="display: none;">Restablecer la contraseña</p>

    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px 0 30px 0;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: 1px solid #cccccc;">
                    <tr>
                        <td align="center" style="padding: 40px 0 30px 0;">
                            <img src="http://dmarquez.ga/img/logos/logoicono.png" alt="Logo del portafolio" width="100" height="100" style="display: block;"/>
                            <hr style="margin-left: 25px;margin-right: 25px;">
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                                <tr>
                                    <td style="color: #153643; font-family: Arial, sans-serif;">
                                        <h1 style="font-size: 24px; margin: 0; text-align: center;">Restablecer la contraseña</h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
                                        
                                    <p style="margin: 0; text-align: justify;">
                                    Hola {{$email}},<br><br>
                                    Queríamos informarte que han solicitado cambiar la contraseña de tu plataforma.<br><br>

                                    Si no realizó esta acción, puede ignorar este correo electrónico o si el caso de recuperar el acceso debes ingresar al siguiente enlace. <br><br> 
                                    <br>Expira en 15 minutos.<br>

                                        <p style="text-align: center;">
                                            <a href="https://localhost:8000/password_reset/{{$token}}" target="_blank" style="display:inline-block; min-width:250px; font-family:Tahoma,Arial,sans-serif; font-size:18px; font-weight:bold; color:white; line-height:50px; text-align:center; text-decoration:none; background-color:#6183B0; border-radius:50px; padding:16px 24px; line-height:1">Restablecer la contraseña</a>
                                        </p>

                                        <br>

                                        <p>Por favor, no responda a este correo electrónico con su contraseña. Nunca le pediremos su contraseña y le recomendamos enfáticamente que no la comparta con nadie.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#6183B0" style="padding: 30px 30px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                                <tr>
                                    <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;">
                                        <p style="margin: 0;">&reg; Daniel Márquez<br />
                                        <p> Copyright © All rights reserved</p>
                                    </td>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>