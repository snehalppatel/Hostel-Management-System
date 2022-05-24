<?php

namespace App\Http\Middleware;

use App\Models\Student;
use Closure;
use Illuminate\Http\Request;

class StudentAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->bearerToken() == null) {
            abort(403, 'Unauthorized action.');
            // return new Response('Forbidden', 403);
        }   
            $user = Student::where('access_token', $request->bearerToken())->first();
        if (!$user) {
            abort(403, 'Unauthorized action.');
            // return new Response('Forbidden', 403);
        }        
        return $next($request);
    }
}
