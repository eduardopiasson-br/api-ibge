<?php

namespace Tests\Unit;

use App\Services\BrasilApiService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class BrasilApiServiceTest extends TestCase
{
    public function test_get_municipios()
    {
        // Simulando a resposta da API
        Http::fake([
            'https://brasilapi.com.br/api/ibge/municipios/v1/RS' => Http::response([
                ['nome' => 'Porto Alegre'],
                ['nome' => 'Caxias do Sul'],
                ['nome' => 'Erechim'],
            ], 200)
        ]);

        $service = new BrasilApiService();
        $municipios = $service->getCities('RS');

        $this->assertEquals('Porto Alegre', $municipios[0]['nome']);
        $this->assertEquals('Caxias do Sul', $municipios[1]['nome']);
        $this->assertEquals('Erechim', $municipios[2]['nome']);
        // $this->assertEquals('Medianeira', $municipios[3]['nome']); // error simulation
    }
}
