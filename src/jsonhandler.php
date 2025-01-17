<?php
function loadUsersFromJson($filePath): array
{
    // Verificar si el archivo JSON existe
    if (file_exists($filePath)) {
        // Leer el contenido del archivo
        $jsonContent = file_get_contents($filePath);

        // Decodificar el contenido JSON a un array asociativo
        $users = json_decode($jsonContent, true);

        // Verificar si el contenido decodificado es válido
        if (is_array($users)) {
            return $users;
        }
    }

    // Si el archivo no existe o no contiene datos válidos, retornar un array vacío
    return [];
}

function saveUserToJson($user, $filePath): true
{
    // Verificar si el archivo JSON existe
    if (file_exists($filePath)) {
        // Leer el contenido actual del archivo
        $users = json_decode(file_get_contents($filePath), true);

        // Verificar si hay un error al decodificar JSON
        if (!is_array($users)) {
            $users = []; // Si hay un error, inicializar como un array vacío
        }
    } else {
        // Si no existe, inicializar como un array vacío
        $users = [];
    }

    // Agregar el nuevo usuario al array
    $users[] = $user;

    // Guardar el contenido actualizado al archivo JSON
    file_put_contents($filePath, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    return true;
}
function readPokemonTypes($filePath, $type): string
{
    // Validar si el archivo existe
    if (!file_exists($filePath)) {
        throw new Exception("El archivo JSON no existe: {$filePath}");
    }

    // Leer el contenido del archivo
    $jsonContent = file_get_contents($filePath);

    // Decodificar el JSON a un array asociativo
    $pokemonTypes = json_decode($jsonContent, true);

    // Validar si la decodificación fue exitosa
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Error al decodificar el JSON: " . json_last_error_msg());
    }

    // Asegurarte de que $type sea una cadena (extraer el nombre del tipo si es un array)
    if (is_array($type) && isset($type['name'])) {
        $type = $type['name'];
    } elseif (is_array($type)) {
        throw new Exception("Formato de tipo inválido: el array no contiene la clave 'name'.");
    }

    // Inicializar variable para almacenar el color del tipo
    $pokemonColor = null;

    // Recorrer los tipos de Pokémon y buscar el color asociado al tipo especificado
    foreach ($pokemonTypes as $apiType => $color) {
        // Comprobar si el tipo actual coincide con el solicitado
        if ($apiType === $type) {
            $pokemonColor = $color;
            break; // Salir del bucle una vez encontrado
        }
    }

    // Validar si se encontró el color
    if ($pokemonColor === null) {
        throw new Exception("No se encontró el color para el tipo: {$type}");
    }

    return $pokemonColor;
}
