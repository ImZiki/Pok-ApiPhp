<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/styles/styles.css">
</head>
<body>
<?php require_once "header.php"; ?>
<div class="container">
    <div class="search-section">
        <form method="POST">
            <label for="pokemon">Nombre o ID del Pokémon:</label>
            <input type="text" id="pokemon" name="pokemon" placeholder="Ej: Pikachu">
            <input type="submit" value="Buscar">
        </form>
    </div>
    <div class="divider"></div>
    <div class="card-section">
    <?php
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
            try {
                $filePath = '../assets/databases/pokecolors.json';
                $headerColor = readPokemonTypes($filePath, $pokeData['type']) ?? 'black';
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            $soundFile = '../assets/sound/cries_pokemon_latest_25.ogg';
            // Datos del Pokémon para mostrar
            $pokemon = [
                'sprite' => $pokeData['sprite'],
                'name' => ucfirst($pokeData['name']),
                'type' => [ucfirst($pokeData['type']['name'])],
                'stats' => [
                    'HP' => $pokeData['hp'],
                    'Attack' => $pokeData['attack'],
                    'Defense' => $pokeData['defense'],
                    'Special Attack' => $pokeData['spec-attk'],
                    'Special Defense' => $pokeData['spec-def'],
                ],
            ];
        }
    ?>
        <div class="pokemon-card">
            <div class="header" style="background-color: <?= htmlspecialchars($headerColor, ENT_QUOTES, 'UTF-8') ?>;">
                <img src="<?= htmlspecialchars($pokemon['sprite'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($pokemon['name'], ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="content">
                <h3><?= htmlspecialchars($pokemon['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                <p><strong>Type:</strong> <?= htmlspecialchars(implode(", ", $pokemon['type']), ENT_QUOTES, 'UTF-8') ?></p>
                <?php foreach ($pokemon['stats'] as $statName => $statValue): ?>
                    <p><strong><?= htmlspecialchars($statName, ENT_QUOTES, 'UTF-8') ?>:</strong> <?= htmlspecialchars($statValue, ENT_QUOTES, 'UTF-8') ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
