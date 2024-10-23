<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CitiesControllerTest extends TestCase
{
    public function test_get_cities_brasilapi()
    {
        Http::fake([
            'https://brasilapi.com.br/api/ibge/municipios/v1/RS' => Http::response([
                ['nome' => 'Porto Alegre'],
                ['nome' => 'Caxias do Sul'],
                // ['nome' => 'Caxias do Norte'], // error simulation
            ], 200)
        ]);

        $response = $this->get('api/cities/brasilapi/RS');

        $response->assertStatus(200);

        $response->assertJson([
            ['nome' => 'Porto Alegre'],
            ['nome' => 'Caxias do Sul'],
            // ['nome' => 'Medianeira'] // error simulation
        ]);
    }
}
