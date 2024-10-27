<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="mobile-web-app-capable" content="yes" />
        <title>{{$title}}</title>

        <!-- Fonts -->
        <!-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> -->

        <!-- Styles -->
        <style>
          *{
            line-height:1.5;
            font-family: sans-serif;
            font-weight: 100;
            font-style: normal;
          }
          .text-primary{
            color: #0449fb;
            font-size: 1.1rem;
            font-weight: bold;
            
          }
          .text-secondary{
            color: grey;
            font-size: 0.9rem;
            font-weight: 400;
            
          }
          .text-title{
            color: #1a1a1a;
            font-size: 1.1rem;
            font-weight: bold;
          }
          .text-h1{
            text-align: center;
            color: #1a1a1a;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
          }
        </style>
    </head>
    <!-- <body class="antialiased"> -->
    <body class="antialiased mobile touch">

        <div style="height:100vh; background:white; width:100%; ">
          <div style="width: 80%; background:white; margin:auto; border-radius: 20px; border:1px solid grey; padding: 2rem; ">
            <div>
              <h1 class="text-h1">{{$title}}</h1>
            </div>
              @for($i=0; $i < count($transaction); $i++)
              <div style="padding: 0.5rem 2rem; border-bottom: 2px solid #d9d9d9">

                @foreach($transaction[$i] as $clave => $valor)
                  <div style="margin:0.15rem 0px;" class="{{$clave == 'value' ? 'text-primary' : ($clave == 'title' ? 'text-title' :'text-secondary') }}">
                    {{$valor}}
                  </div>
                @endforeach
              </div>

              @endfor
          </div>
        </div>

    </body>
</html>
