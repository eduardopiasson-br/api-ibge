<?php

namespace App\Http\Controllers;

use App\Services\BrasilApiService;
use App\Services\IbgeApiService;

class CitiesController extends Controller
{
    protected $brasilApiService;
    protected $ibgeApiService;

    public function __construct(BrasilApiService $brasilApiService, IbgeApiService $ibgeApiService)
    {
        $this->brasilApiService = $brasilApiService;
        $this->ibgeApiService = $ibgeApiService;
    }

    public function getCitiesFromBrasilApi($uf)
    {
        $cities = $this->brasilApiService->getcities($uf);
        return response()->json($cities);
    }

    public function getCitiesFromIbgeApi($uf)
    {
        $cities = $this->ibgeApiService->getcities($uf);
        return response()->json($cities);
    }
}
