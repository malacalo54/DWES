<?php

define('PIEDRA1', "&#x1F91C;");
define('PIEDRA2', "&#x1F91B;");
define('TIJERAS', "&#x1F596;");
define('PAPEL', "&#x1F91A;");

function obtenerOpcionAleatoria()
{
    $opciones = ['piedra', 'papel', 'tijeras'];
    return $opciones[array_rand($opciones)];
}


function mostrarSimbolo($opcion, $jugador)
{
    if ($opcion == 'piedra') {
        return $jugador == 1 ? PIEDRA1 : PIEDRA2;
    } elseif ($opcion == 'papel') {
        return PAPEL;
    } else {
        return TIJERAS;
    }
}

function determinarGanador($jugador1, $jugador2)
{
    if ($jugador1 == $jugador2) {
        return "¡Empate!";
    } elseif (
        ($jugador1 == 'piedra' && $jugador2 == 'tijeras') || 
        ($jugador1 == 'tijeras' && $jugador2 == 'papel') ||
        ($jugador1 == 'papel' && $jugador2 == 'piedra')
    ) {
        return "🎉 Gana el jugador 1 🎉";
    } else {
        return "😓 Gana el jugador 2 😓";
    }
}

$jugador1 = '';
$jugador2 = '';
$resultado = '';

$jugador1 = strtolower($_POST['jugador1']);

if (in_array($jugador1, ['piedra', 'papel', 'tijeras'])) {

    $jugador2 = obtenerOpcionAleatoria();

    $resultado = determinarGanador($jugador1, $jugador2);
} else {
    $resultado = "Por favor, elija una opción válida: Piedra, Papel o Tijeras.";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>¡Piedra, Papel, Tijera!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .resultado {
            font-size: 1.5em;
            margin-top: 20px;
        }

        table {
            margin: auto;

        }

        input {
            padding: 10px;
        }

        td {


            font-size: 200px;
            padding: 10px;
        }

        form {
            font-size: 20px;

        }
    </style>
</head>

<body>
    <h1>¡Piedra, papel, tijera!</h1>
    <form method="post" action="">
        <label for="jugador1">Jugador 1: Escribe "piedra", "papel" o "tijeras":</label><br>
        <input type="text" id="jugador1" name="jugador1" required><br><br>
        <input type="submit" value="Jugar">
    </form>
        <table>
            <tr>
                <th>Jugador 1</th>
                <th>Jugador 2</th>
            </tr>
            <tr>
                <td><?php echo mostrarSimbolo($jugador1, 1); ?></td>
                <td><?php echo mostrarSimbolo($jugador2, 2); ?></td>
            </tr>
        </table>

        <div class="resultado">
            <?php echo $resultado; ?>
        </div>
</body>

</html>
