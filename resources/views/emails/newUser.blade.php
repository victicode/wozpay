<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
    
    *{
      font-family:arial
    }
    .u-button:hover{
      opacity:0.5
    }
    </style>
  </head>
  <body
    style="
      margin: 0;
      padding-top: 0;
      padding-right: 0;
      padding-bottom: 0;
      padding-left: 0;
      min-width: 100%;
      background: url(https://bluecomunicadores.com/pulsesystem/public/mail/images/pattern.jpg);
    "
  >
    <div style="
  
      margin-right: 15%;
      margin-left: 15%;
      padding: 1.4rem 5%;
      background: white;
    "
    >
      <div style="
        font-size:1.8rem;
        text-align:center;
        font-weight:bold
      ">
        Verificación de identidad
      </div>
      <div style="
        font-size:1.03rem;
        font-weight:500;
        margin-top: 2rem
      ">

        <div style="margin-top:2rem; line-height:1.5; text-align:center">
            El usuario <b>{{$user->name}}</b> ha registrado los documentos necesario para la verificación.
            <br>Por favor procede con este proceso para que el cliente pueda optar por beneficios
        </div> 

        <div style="
          font-size:1.2rem;
          font-weight:bold;
          margin-top:2rem
        ">

        </div>

        <div class="u-button"  style="
          margin:auto;
          width: 10rem;
          background: blue;
          padding: 1rem;
          border-radius: 1rem;
          margin-top:2rem;
          text-align:center;
          transition:all 0.4s ease-in-out;
        ">
          <a style="color:white;text-decoration:none;" href="{{ config('app.url') }}admin/user/verification/{{ $user->id }}" target="_blank">
            Atender solicitud
          </a>
        </div>
      </div>

    </div>
  </body>
</html>
