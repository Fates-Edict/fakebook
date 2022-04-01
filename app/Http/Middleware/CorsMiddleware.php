<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $illuminateResponse = 'Illuminate\Http\Response';
      $symfonyResponse = 'Symfony\Component\HttpFoundation\Response';

      $headers = [
        'Access-Control-Allow-Origin'       => 'http://localhost:8080',
        'Access-Control-Allow-Methods'      => 'POST, GET, OPTIONS, PUT, DELETE',
        'Access-Control-Allow-Credentials'  => 'true',
        'Access-Control-Max-Age'            => '86400',
        'Access-Control-Allow-Headers'      => '*'
      ];

      if ($request->isMethod('OPTIONS'))
        {
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }

		  $response = $next($request);

      if($response instanceof $illuminateResponse) {
        foreach ($headers as $key => $value) {
          $response->header($key, $value);
        }
        return $response;
      }

      if($response instanceof $symfonyResponse) {
        foreach ($headers as $key => $value) {
          $response->headers->set($key, $value);
        }
        return $response;
      }
    }
}
