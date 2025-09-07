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
        Pago - deposito
      </div>
      <div style="
        font-size:1.03rem;
        font-weight:500;
        margin-top: 2rem
      ">

        <div style="text-align: right; font-weight:bold">
          {{ 
            date("d/m/Y h:i:s A", strtotime($pay->created_at))
          
          }}  
        </div>
        <div style="margin-top:2rem; line-height:1.5">
          Se ha registrado un pago bajo el número <b> #{{ $pay->operation_id }}</b>, por motivo de<b>{{ $pay->concept }}</b>
        </div>
        <div style="
          font-size:1.2rem;
          font-weight:bold;
          margin-top:2rem
        ">
          Detalles del pago
        </div>
        
        <div style="border-top: 1rem solid blue; margin-top:1rem; padding-top:1rem">
         <table style="width:100%; border-collapse: collapse;">
          <thead style="">
              <th style="text-align:center; width:15%; 
              border-top:1px solid black;
              padding:10px;
              border-left:1px solid black;
              ">Usuario</th>
              
              <th style="text-align:center; width:15%; 
              border-top:1px solid black;
              padding:10px;
              ">Método de pago</th>
              <th style="text-align:center; width:15%; 
              border-right:1px solid black;
              border-top:1px solid black;
              padding:10px;
              ">Descripción</th>
              <th style="text-align:center; width:15%; 
              border-top:1px solid black;
              border-right:1px solid black;
              padding:10px;
              ">Monto</th>

          </thead>
          <tbody>
          
            <tr>

              <td style="
                padding: 10px; 
                text-align:center;
                border: 1px solid black 
              ">
              
                {{ $pay->user->name }}
              </td>
              <td style="
                padding: 10px; 
                text-align:center;
                border: 1px solid black 
              ">
              
                Transferencia bancaria
              </td>
              <td style="
                padding: 10px; 
                text-align:center;
                border: 1px solid black 
              ">
              
                {{ $pay->concept }}
              </td>

              <td style="
                padding: 10px; 
                text-align:center;
                border: 1px solid black 
              ">
              
                 Gs. {{ number_format($pay->amount, 0, '.', ',')}}
              </td>

            </tr>
          </tbody>
         </table>
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
          <a style="color:white;text-decoration:none;" href="{{ config('app.url') }}admin/paysDetailsOther/{{ $pay->id }}" target="_blank">
            Atender solicitud
          </a>
        </div>
      </div>

    </div>
  </body>
</html>
