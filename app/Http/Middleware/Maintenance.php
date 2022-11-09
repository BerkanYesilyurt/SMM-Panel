<?php

namespace App\Http\Middleware;

use App\Enums\UserAuthorityEnum;
use App\Models\Config;
use Closure;
use Illuminate\Http\Request;

class Maintenance
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
        $maintenance_mode = $config->where('name','=', 'maintenance_mode')->value('value');
        if($maintenance_mode){
            if(auth()->check() && auth()->user()->authority != UserAuthorityEnum::none->value){
                return $next($request);
            }else{
                return response()->view('undermaintenance');
            }
        }
        return $next($request);
    }
}
