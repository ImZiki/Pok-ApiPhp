 <?php if( !headers_sent() && '' == session_id() ) {session_start();}

        require_once './utils/apihandler.php';
        $response = getPokemon();
        $pokemon = $response["pokemon"];
        $headerColor = $response["color"];
?>
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
