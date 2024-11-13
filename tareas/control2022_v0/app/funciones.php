<?php
require_once('dat/datos.php');

/**
 *  Devuelve true si el código del usuario y contraseña se 
 *  encuentran en la tabla de usuarios
 *  @param $login : Código de usuario
 *  @param $clave : Clave del usuario
 *  @return true o false
 */
function userOk($login, $clave): bool
{
    global $usuarios;
    return isset($usuarios[$login]) && $usuarios[$login][1] === $clave;
}

/**
 *  Devuelve el rol asociado al usuario
 *  @param $login: código de usuario
 *  @return int ROL_ALUMNO o ROL_PROFESOR
 */
function getUserRol($login)
{
    global $usuarios;
    if (isset($usuarios[$login])) {
        return $usuarios[$login][2];
    } else {
        return ROL_ALUMNO;
    }
}

/**
 *  Muestra las notas del alumno indicado.
 *  @param $codigo: Código del usuario
 *  @return string : Devuelve una cadena con una tabla html con los resultados 
 */
function verNotasAlumno($codigo): string
{
    $msg = "";
    global $nombreModulos;
    global $notas;
    global $usuarios;

    if (isset($usuarios[$codigo]) && getUserRol($codigo) === ROL_ALUMNO) {
        $nombre = $usuarios[$codigo][0];
        $msg .= "Bienvenido/a alumno/a: $nombre </br>";
        $msg .= "<table><tr><th>Asignatura</th><th>Nota</th></tr>";

        if (isset($notas[$codigo])) {
            foreach ($nombreModulos as $index => $modulo) {
                $nota = $notas[$codigo][$index];
                $msg .= "<tr><td>$modulo</td><td>$nota</td></tr>";
            }
            $msg .= "</table>";
        }
    }
    return $msg;
}

/**
 *  Muestra las notas de todos los alumnos. 
 *  @param $codigo: Código del profesor
 *  @return string : Devuelve una cadena con una tabla html con los resultados 
 */
function verNotaTodas($codigo): string
{
    $msg = "";
    global $nombreModulos;
    global $notas;
    global $usuarios;

    if (isset($usuarios[$codigo]) && getUserRol($codigo) === ROL_PROFESOR) {
        $nombre = $usuarios[$codigo][0];
        $msg .= "Bienvenido Profesor: D. $nombre <br>";
        $msg .= "<table><tr><th>Alumno</th>";

        foreach ($nombreModulos as $modulo) {
            $msg .= "<th>$modulo</th>";
        }
        $msg .= "</tr>";

        foreach ($notas as $codigoAlumno => $notasAlumno) {
            $nombreAlumno = $usuarios[$codigoAlumno][0];
            $msg .= "<tr><td>$nombreAlumno</td>";

            foreach ($nombreModulos as $index => $modulo) {
                $nota = $notasAlumno[$index];
                $msg .= "<td> $nota </td>";
            }
            $msg .= "</tr>";
        }
        $msg .= "</table>";
    }
    return $msg;
}

?>