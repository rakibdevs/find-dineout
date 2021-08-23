<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function countGroupedByDay($model, $days = 7)
    {
        $lastDate = Carbon::now()->subDays($days - 1);
        $results = $model::selectRaw("COUNT(*) count, DATE_FORMAT(created_at, '%Y-%m-%e') date")
            ->where('created_at', '>=', $lastDate)
            ->groupBy('date')
            ->pluck('count','date');


        $periods = new \DatePeriod($lastDate, CarbonInterval::day(), Carbon::tomorrow());
        return $graph = array_map(function ($period) use ($results) {
            $date = $period->format('Y-m-d');
            return (object)[
                'date'  => $period->format('Y-m-d'),
                'count' => isset($results[$date]) ? $results[$date]: 0,
            ];
        }, iterator_to_array($periods));
    }
}
