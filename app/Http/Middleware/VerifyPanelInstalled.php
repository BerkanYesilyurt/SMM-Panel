<?php

namespace App\Http\Middleware;

use App\Models\Config;
use Closure;
use Illuminate\Http\Request;

class VerifyPanelInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $config = new Config();
        $isPanelInstalled = $config->where('name','=', 'is_installed')->value('value');
        if($isPanelInstalled == 1){
            return $next($request);
        }else{
            return redirect()->route('install');
        }
    }
}
