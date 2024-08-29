<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Models\Location;
use App\Models\Forecast;

class ForecastApiController extends Controller
{

    public function append(Request $request)
    {
        $item = Location::create($request->all());
        return response()->json($item, 201);
    }

    public function show(Request $request)
    {

        $requestKey = sprintf('request_%s_%s_%s', $request->location, $request->startDate, $request->endDate);

        $result = Cache::get($requestKey, function() use (&$request) {

            $cacheKey = sprintf('location_%s', $request->location);
            $locationId = Cache::get($cacheKey, function () use (&$request) {
                return DB::table('locations')
                    ->where('name', $request->location)
                    ->value('id');
            });

            $startDate = Carbon::createFromTimestamp($request->startDate);
            $endDate = Carbon::createFromTimestamp($request->endDate);

            $result = DB::table('forecasts')
                ->where('location_id', $locationId)
                ->where('datetime', '>=', $startDate)
                ->where('datetime', '<=', $endDate)
                ->get();

            return $result;
        });
        return response()->json($result);
    }
}
