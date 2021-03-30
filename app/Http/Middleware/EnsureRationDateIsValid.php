<?php

namespace App\Http\Middleware;

use App\Models\Ration;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class EnsureRationDateIsValid
{
    protected $now;
    protected $date;

    public function __construct(Request $request)
    {
        $this->now = Carbon::now();
        $params = $request->route()->parameters();
        $this->date = Carbon::create($params['year'], $params['month'], $params['day']);
        $request['ration'] = Ration::select('rations.*')
            ->join('recipes', 'rations.recipe_id', '=', 'recipes.id')
            ->where('slug', $params['slug'])
            ->where('available_at', $this->date->format('Y-m-d'))
            ->first();
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        session(['schedule:date' => $this->date]);

        if ($this->date < $this->now) {
            return redirect()->route('rations.schedule');
        }
        if (! $request['ration'] ) {
            return redirect()->route('rations.schedule');
        }
    
        return $next($request);
    }
}
