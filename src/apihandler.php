<?php
    function getPokemon(): array{
        $pokemon = isset($_POST["pokemon"]) && !empty(trim($_POST["pokemon"])) ? $_POST["pokemon"] : rand(1, 1025);

        include 'jsonhandler.php';
        $ch = curl_init("https://pokeapi.co/api/v2/pokemon/$pokemon");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $pokemonRes = json_decode($response, true);
        curl_close($ch);

        if (isset($pokemonRes['sprites']['front_default'], $pokemonRes['types'][0]['type'], $pokemonRes['stats'][0]['base_stat'])) {
            $pokeData = [
                'sprite' => $pokemonRes['sprites']['front_default'],
                'name' => $pokemonRes['name'],
                'type' => $pokemonRes['types'][0]['type'],
                'hp' => $pokemonRes['stats'][0]['base_stat'],
                'attack' => $pokemonRes['stats'][1]['base_stat'],
                'defense' => $pokemonRes['stats'][2]['base_stat'],
                'spec-attk' => $pokemonRes['stats'][3]['base_stat'],
                'spec-def' => $pokemonRes['stats'][4]['base_stat']
            ];
            $filePath = '../assets/databases/pokecolors.json';
            $headerColor = readPokemonTypes($filePath, $pokeData['type']) ?? 'black';

        }
        return [
            'pokemon' => ['sprite' => $pokeData['sprite'],
                'name' => ucfirst($pokeData['name']),
                'type' => [ucfirst($pokeData['type']['name'])],
                'stats' => [
                    'HP' => $pokeData['hp'],
                    'Attack' => $pokeData['attack'],
                    'Defense' => $pokeData['defense'],
                    'Special Attack' => $pokeData['spec-attk'],
                    'Special Defense' => $pokeData['spec-def'],
                ]],
            'color' => $headerColor,

        ];
    }