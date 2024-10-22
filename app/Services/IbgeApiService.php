<?php

namespace App\Services;

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
            return $response->json();
        }

        throw new \Exception('Erro ao obter municípios da API do IBGE');
    }
}
