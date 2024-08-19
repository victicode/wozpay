<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sanctum.csrf-cookie',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/health-check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.healthCheck',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/execute-solution' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.executeSolution',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/update-config' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.updateConfig',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/auth/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user.',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/auth/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user.generated::lmLpidfilcmj9oUL',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/auth/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user.generated::QduVj9hSosa00vPU',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/auth/current_user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user.generated::rNaORiYjuTfknn4O',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/get-users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MmepHmHH3iLyZBNQ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/create_wallet' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::o73o8lRvwyFiOxfp',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user.generated::jlKRaLFniWKgEZwZ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/sendPhoneCode' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user.generated::bYYvuZNo4kWgQ2Vq',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/user/verifyPhoneCode' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user.generated::znDP2E1OFreHsUSj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/banks' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bank.',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/accounts_bank' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'accountsBank.',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/loan' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'loan.',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/card' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'card.',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/pay' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pay.',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/pay/get_url' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pay.generated::DhGqOWAeFA1htE8R',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/api/(?|user/u/([^/]++)(*:30)|notifications/(?|([^/]++)(*:62)|seeAll/([^/]++)(*:84))|accounts_bank/(?|([^/]++)(?|(*:120))|delete/([^/]++)(*:144))|loan/([^/]++)(*:166)|card/(?|([^/]++)(*:190)|delete/([^/]++)(*:213))|transfer/([^/]++)(*:239))|/(.*)(*:253))/?$}sDu',
    ),
    3 => 
    array (
      30 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'user.generated::gxsITAonnjFh4Wud',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      62 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'notification.',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      84 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'notification.generated::P5QsS7wCz4CYuSHl',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      120 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'accountsBank.generated::zv0SxcDkKD0lYxYX',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'accountsBank.generated::V6g34JS83GlqqEoj',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      144 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'accountsBank.generated::5PKlQRfcQVj003Z6',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      166 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'loan.generated::py7HCDjzkOedeI8a',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      190 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'card.generated::FmVOzUrG5919BoQp',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      213 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'card.generated::OanMenneAAaW2wXs',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      239 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'transfer.',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      253 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::s06d21kgQI2KAfFH',
          ),
          1 => 
          array (
            0 => 'any',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'sanctum.csrf-cookie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'sanctum.csrf-cookie',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.healthCheck' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_ignition/health-check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController',
        'as' => 'ignition.healthCheck',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.executeSolution' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/execute-solution',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController',
        'as' => 'ignition.executeSolution',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.updateConfig' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/update-config',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController',
        'as' => 'ignition.updateConfig',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user.' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/auth/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\AuthController@login',
        'controller' => 'App\\Http\\Controllers\\Api\\AuthController@login',
        'as' => 'user.',
        'namespace' => NULL,
        'prefix' => 'api/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user.generated::lmLpidfilcmj9oUL' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/auth/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@store',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@store',
        'as' => 'user.generated::lmLpidfilcmj9oUL',
        'namespace' => NULL,
        'prefix' => 'api/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user.generated::QduVj9hSosa00vPU' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/auth/logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => '\\App\\Http\\Controllers\\Api\\AuthController@logout',
        'controller' => '\\App\\Http\\Controllers\\Api\\AuthController@logout',
        'as' => 'user.generated::QduVj9hSosa00vPU',
        'namespace' => NULL,
        'prefix' => 'api/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user.generated::rNaORiYjuTfknn4O' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/auth/current_user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => '\\App\\Http\\Controllers\\Api\\AuthController@getUser',
        'controller' => '\\App\\Http\\Controllers\\Api\\AuthController@getUser',
        'as' => 'user.generated::rNaORiYjuTfknn4O',
        'namespace' => NULL,
        'prefix' => 'api/auth',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MmepHmHH3iLyZBNQ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/get-users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::MmepHmHH3iLyZBNQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::o73o8lRvwyFiOxfp' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/create_wallet',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@storeWallet',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@storeWallet',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::o73o8lRvwyFiOxfp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user.generated::jlKRaLFniWKgEZwZ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@index',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@index',
        'as' => 'user.generated::jlKRaLFniWKgEZwZ',
        'namespace' => NULL,
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user.generated::gxsITAonnjFh4Wud' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/u/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@updateUser',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@updateUser',
        'as' => 'user.generated::gxsITAonnjFh4Wud',
        'namespace' => NULL,
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user.generated::bYYvuZNo4kWgQ2Vq' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/sendPhoneCode',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@sendMobileVerifyCode',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@sendMobileVerifyCode',
        'as' => 'user.generated::bYYvuZNo4kWgQ2Vq',
        'namespace' => NULL,
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'user.generated::znDP2E1OFreHsUSj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/user/verifyPhoneCode',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\UserController@verifyPhoneNumber',
        'controller' => 'App\\Http\\Controllers\\Api\\UserController@verifyPhoneNumber',
        'as' => 'user.generated::znDP2E1OFreHsUSj',
        'namespace' => NULL,
        'prefix' => 'api/user',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'notification.' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/notifications/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\NotificationController@getAllByUser',
        'controller' => 'App\\Http\\Controllers\\Api\\NotificationController@getAllByUser',
        'as' => 'notification.',
        'namespace' => NULL,
        'prefix' => 'api/notifications',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'notification.generated::P5QsS7wCz4CYuSHl' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/notifications/seeAll/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\NotificationController@seeAllByUser',
        'controller' => 'App\\Http\\Controllers\\Api\\NotificationController@seeAllByUser',
        'as' => 'notification.generated::P5QsS7wCz4CYuSHl',
        'namespace' => NULL,
        'prefix' => 'api/notifications',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bank.' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/banks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BankAccountController@getBanks',
        'controller' => 'App\\Http\\Controllers\\Api\\BankAccountController@getBanks',
        'as' => 'bank.',
        'namespace' => NULL,
        'prefix' => 'api/banks',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'accountsBank.' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/accounts_bank',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BankAccountController@storeAccountBank',
        'controller' => 'App\\Http\\Controllers\\Api\\BankAccountController@storeAccountBank',
        'as' => 'accountsBank.',
        'namespace' => NULL,
        'prefix' => 'api/accounts_bank',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'accountsBank.generated::zv0SxcDkKD0lYxYX' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/accounts_bank/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BankAccountController@getAccountsBanksByUser',
        'controller' => 'App\\Http\\Controllers\\Api\\BankAccountController@getAccountsBanksByUser',
        'as' => 'accountsBank.generated::zv0SxcDkKD0lYxYX',
        'namespace' => NULL,
        'prefix' => 'api/accounts_bank',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'accountsBank.generated::V6g34JS83GlqqEoj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/accounts_bank/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BankAccountController@updateAccountBank',
        'controller' => 'App\\Http\\Controllers\\Api\\BankAccountController@updateAccountBank',
        'as' => 'accountsBank.generated::V6g34JS83GlqqEoj',
        'namespace' => NULL,
        'prefix' => 'api/accounts_bank',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'accountsBank.generated::5PKlQRfcQVj003Z6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/accounts_bank/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\BankAccountController@destroyAccountBank',
        'controller' => 'App\\Http\\Controllers\\Api\\BankAccountController@destroyAccountBank',
        'as' => 'accountsBank.generated::5PKlQRfcQVj003Z6',
        'namespace' => NULL,
        'prefix' => 'api/accounts_bank',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'loan.' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/loan',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LoanController@storeLoan',
        'controller' => 'App\\Http\\Controllers\\Api\\LoanController@storeLoan',
        'as' => 'loan.',
        'namespace' => NULL,
        'prefix' => 'api/loan',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'loan.generated::py7HCDjzkOedeI8a' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/loan/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\LoanController@getActiveLoan',
        'controller' => 'App\\Http\\Controllers\\Api\\LoanController@getActiveLoan',
        'as' => 'loan.generated::py7HCDjzkOedeI8a',
        'namespace' => NULL,
        'prefix' => 'api/loan',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'card.' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/card',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CardController@linkCard',
        'controller' => 'App\\Http\\Controllers\\Api\\CardController@linkCard',
        'as' => 'card.',
        'namespace' => NULL,
        'prefix' => 'api/card',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'card.generated::FmVOzUrG5919BoQp' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/card/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CardController@getLinkCard',
        'controller' => 'App\\Http\\Controllers\\Api\\CardController@getLinkCard',
        'as' => 'card.generated::FmVOzUrG5919BoQp',
        'namespace' => NULL,
        'prefix' => 'api/card',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'card.generated::OanMenneAAaW2wXs' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/card/delete/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\CardController@deleteCard',
        'controller' => 'App\\Http\\Controllers\\Api\\CardController@deleteCard',
        'as' => 'card.generated::OanMenneAAaW2wXs',
        'namespace' => NULL,
        'prefix' => 'api/card',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'transfer.' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/transfer/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\TransferController@getTransferById',
        'controller' => 'App\\Http\\Controllers\\Api\\TransferController@getTransferById',
        'as' => 'transfer.',
        'namespace' => NULL,
        'prefix' => 'api/transfer',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pay.' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/pay',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\PayController@storePay',
        'controller' => 'App\\Http\\Controllers\\Api\\PayController@storePay',
        'as' => 'pay.',
        'namespace' => NULL,
        'prefix' => 'api/pay',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pay.generated::DhGqOWAeFA1htE8R' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/pay/get_url',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'jwt.verify',
        ),
        'uses' => 'App\\Http\\Controllers\\Api\\PayController@payRequest',
        'controller' => 'App\\Http\\Controllers\\Api\\PayController@payRequest',
        'as' => 'pay.generated::DhGqOWAeFA1htE8R',
        'namespace' => NULL,
        'prefix' => 'api/pay',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::s06d21kgQI2KAfFH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '{any}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:55:"Laravel\\SerializableClosure\\UnsignedSerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:40:"function () {
    return \\view(\'app\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000005a30000000000000000";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::s06d21kgQI2KAfFH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
        'any' => '.*',
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
