<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include_once('captura.html');
    exit();
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST["nombre"]);
    $alias = htmlspecialchars($_POST["alias"]);
    $edad = htmlspecialchars($_POST["edad"]);
    $artes_magicas = htmlspecialchars($_POST["artes_magicas"]);
    $armas = isset($_POST['arma']) ? $_POST['arma'] : 'Ninguna';

    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $imagen_nombre = $_FILES["imagen"]["name"];
        $imagen_temporal = $_FILES["imagen"]["tmp_name"];
        $ruta_imagen = "uploads/" . $imagen_nombre;
        $tamaño = $_FILES['imagen']['size'];
        $tipo = mime_content_type($imagen_temporal);
        $tamaño_maximo = 2097152;

        if (!file_exists('formularioImg/uploads/')) {
            mkdir('formularioImg/uploads/', 0777, true);
        }
        if ($tipo == 'image/png' && $tamaño <= $tamaño_maximo) {
            if (move_uploaded_file($imagen_temporal, $ruta_imagen)) {
                echo " <div class='texto'>Imagen subida <br> con exito</div>";
            } 
        }else {
            echo " <div class='error'>Error al subir la imagen</div>";
            $ruta_imagen = "uploads/calavera.png";
        }
    } else {
        echo " <div class='error'>Ninguna imagen selecionada</div>";
        $ruta_imagen = "uploads/calavera.png";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del Jugador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ecf0f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background-color: rgb(255, 255, 68);
            width: 350px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
            position: relative;
        }

        h2 {
            font-size: 22px;
            color: black;
            margin-bottom: 15px;
            text-align: center;
        }

        .avatar {
            position: absolute;
            top: 100px;
            right: 20px;
            width: 120px;
            height: 120px;
            object-fit: cover;

        }

        .info {
            text-align: left;
            font-size: 16px;
            margin-right: 130px;
        }

        .info strong {
            color: black;
        }

        .error {
            color: red;
            font-size: 18px;
        }

        .texto {
            color: rgb(83, 180, 53);
        }
    </style>
</head>

<body>

    <div class="card">
        <h2>Datos del Jugador</h2>
        <img class="avatar" src="<?php echo $ruta_imagen; ?>" alt="Imagen del jugador">
        <div class="info">
            <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
            <p><strong>Alias:</strong> <?php echo $alias; ?></p>
            <p><strong>Edad:</strong> <?php echo $edad; ?></p>
            <p><strong>Armas seleccionadas:</strong> <?php echo is_array($armas) ? implode(", ", $armas) : $armas; ?>
            </p>
            <p><strong>¿Practica artes mágicas?:</strong> <?php echo $artes_magicas; ?></p>
        </div>
    </div>

</body>

</html>