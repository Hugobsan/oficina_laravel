<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MarkMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Adicionando prefixo da rota na section para ativar item de menu
        $prefixo = explode('/', $request->route()->getPrefix())[0];
        $request->session()->put('menuAtivo', $prefixo);
        $request->session()->save();
        return $next($request);
    }
}
