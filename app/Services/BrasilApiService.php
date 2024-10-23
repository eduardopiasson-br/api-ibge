<?php

namespace App\Services;

use App\Helpers\PaginationHelper;
use Illuminate\Support\Facades\Http;

class BrasilApiService
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.brasil_api_provider');
    }

    public function getCities($uf)
    {
        $response = Http::get($this->apiUrl . $uf);

        if ($response->successful()) {
            $cities = $response->json();

            return response()->json(PaginationHelper::paginate($cities));
        }

        throw new \Exception('Erro ao obter municípios da Brasil API');
    }
}
