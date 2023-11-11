<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MiscApiController extends Controller
{
    public function getAirportsByCountry(Request $request)
    {
        Log::info($request->all());
        $airports = Airport::where('iso_country', $request->iso_country)->where('name', 'like', '%' . strval($request->term) . '%')->simplePaginate(10);

        $morePages = true;
        $pagination_obj = json_encode($airports);
        if (empty($airports->nextPageUrl())) {
            $morePages = false;
        }
        $results = array(
            "results" => $airports->items(),
            "pagination" => array(
                "more" => $morePages
            )
        );

        return response()->json($results);
    }
}
