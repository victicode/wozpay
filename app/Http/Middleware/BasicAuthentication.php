<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
 
class BasicAuthentication
{
    private const USER= 'tpagoRequest';
    private const PASS= '12f$4.YZp-1+';
 
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('Authorization') === false) {
            // Display login prompt
            header('WWW-Authenticate: Basic realm="HiBit"');
            exit;
        }
 
        $credentials = base64_decode(substr($request->header('Authorization'), 6));
        list($username, $password) = explode(':', $credentials);
 
        if ($username !== self::USER || $password !== self::PASS) {
            // Provided username or password does not match, throw an exception
            // Alternatively, the login prompt can be displayed once more
            throw new HttpException(Response::HTTP_UNAUTHORIZED);
        }
 
        return $next($request);
    }
}