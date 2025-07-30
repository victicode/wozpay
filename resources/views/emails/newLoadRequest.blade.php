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
        Solicitud de prestamo realizada ✅
      </div>
      <div style="
        font-size:1rem;
        font-weight:500;
        margin-top: 1rem
      ">
        <div>
          Hola {{ $loan->user->name }},
        </div>
        <div style="margin-top:2rem; line-height:1.5">
        
          Hemos registrado tu solicitud de prestamo bajo el número <b> #{{ $loan->loan_number }}</b>, 
          nuestro equipo administrativo se encuentra validado y corroborando tus datos y los datos que proporcionastes en dicha solicitud.
        </div>
        <div style="margin-top:2rem">
          Serás notificado por vía correo y por nuestra web sobre la aprobación o rechazo de tu solicitud.
        </div>
        <div style="
          font-size:1.5rem;
          text-align:center;
          font-weight:bold;
          margin-top:2rem
        ">
          ¿Que procede ahora?
        </div>
        <div style="border-top: 1rem solid blue; margin-top:1rem; padding-top:1rem">
          1️⃣ Debes ser paciente, este proceso dura alrededor de 1 a 2 días Habiles. <br><br>
          2️⃣ En el proceso se debe validad que la información proporcionada es correcta y que cuentas 
          con los avales para darte el prestamo.<br><br>
          3️⃣ Debes mantener un saldo positivo en tu cuenta.
        </div>
      </div>
      <div style="
          font-size:1.2rem;
          text-align:center;
          font-weight:500;
          margin-top:4rem
      ">
        Gracias por confiar en nosotros y elegir a Woz Payment como tu aliado💙
      </div>
    </div>
  </body>
</html>
