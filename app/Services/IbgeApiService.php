<?php

namespace App\Services;

use App\Helpers\PaginationHelper;
use Illuminate\Support\Facades\Http;

class IbgeApiService
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('app.ibge_api_provider');
    }

    public function getCities($uf)
    {
        $response = Http::get($this->apiUrl . $uf . '/municipios');

        if ($response->successful()) {
            $cities = $response->json();

            // formatting to bring essential data and standardize the return of both APIs
            $formatedCities = array_map(function($city) {
                return [
                    'nome' => $city['nome'],
                    'codigo_ibge' => $city['id'],
                ];
            }, $cities);

            return response()->json(PaginationHelper::paginate($formatedCities));
        }

        throw new \Exception('Erro ao obter municípios da API do IBGE');
    }
}
