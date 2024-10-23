<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>API IBGE</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <div class="pt-4 row">
            <div class="px-4 col-md-6">
                <h2 class="text-uppercase">Buscador de Cidades e Códigos IBGE</h2>
                <p style="text-align: justify" class="p-2 mb-0 fs-6">Este projeto utiliza uma API que permite buscar informações sobre cidades brasileiras, como o nome e o código IBGE de cada uma delas.</p>
                <p style="text-align: justify" class="p-2 mt-0 fs-6">O IBGE (Instituto Brasileiro de Geografia e Estatística) é responsável pela produção e organização de dados estatísticos e geográficos do Brasil.</p>
            </div>
            <div class="px-4 col-md-6">
                <h2>BUSCAR CIDADES</h2>

        <div class="mb-4 form-group">
            <label for="estado">Selecione o Estado:</label>
            <select id="estado" class="form-control">
                <option value="">Selecione</option>
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
            </select>
        </div>

        <button id="brasilApiBtn" class="btn btn-primary">Buscar via Brasil API</button>
        <button id="ibgeApiBtn" class="btn btn-secondary">Buscar via IBGE API</button>
            </div>
        </div>

        <hr>

        <div id="resultados" class="mb-5">
            <table class="table mx-auto text-center table-dark" style="max-width: 40rem">
                <thead>
                    <tr>
                        <th class="w-50">Nome</th>
                        <th class="w-50">Código IBGE</th>
                    </tr>
                </thead>
                <tbody id="tabelaResultados">
                    <!-- Ajax Result -->
                </tbody>
            </table>

            <div id="pagination" class="mt-3 text-center">
                <button class="btn btn-secondary" id="prevPage">Anterior</button>
                <span class="mx-4" id="pageInfo"></span>
                <button class="btn btn-secondary" id="nextPage">Próxima</button>
            </div>
        </div>
    </div>

    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let currentPage = 1;
        let lastPage = 1;

        $(document).ready(function() {
            $('#resultados').hide();

            $('#brasilApiBtn').click(function() {
                fetchCities(1, 1);
            });

            $('#ibgeApiBtn').click(function() {
                fetchCities(1, 2);
            });

            $('#prevPage').click(function() {
                if (currentPage > 1) {
                    fetchCities(currentPage - 1);
                }
            });

            $('#nextPage').click(function() {
                if (currentPage < lastPage) {
                    fetchCities(currentPage + 1);
                }
            });
        });

        // function ajax search cities
        function fetchCities(page = 1, endpoint) {
            $('#resultados').show(200);

            var uf = $('#estado').val();
            var url = endpoint == 1 ? 'api/cities/brasilapi/' + uf + '?page=' + page : 'api/cities/ibgeapi/' + uf + '?page=' + page;
            if (uf) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#tabelaResultados').empty();

                        $.each(response.original.data, function(index, city) {
                            $('#tabelaResultados').append('<tr><td>' + city.nome + '</td><td>' + city.codigo_ibge + '</td></tr>');
                        });

                        currentPage = parseInt(response.original.meta.current_page);
                        lastPage = parseInt(response.original.meta.last_page);

                        renderPaginationInfo();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error: " + textStatus, errorThrown);
                    }
                });
            } else {
                alert("Por favor, selecione um estado.");
            }
        }

        // function update pagination info
        function renderPaginationInfo() {
            $('#pageInfo').text('Página ' + currentPage + ' de ' + lastPage);
            $('#prevPage').prop('disabled', currentPage === 1);
            $('#nextPage').prop('disabled', currentPage === lastPage);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>
