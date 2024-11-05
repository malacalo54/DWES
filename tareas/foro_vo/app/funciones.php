<?php
function usuarioOk($usuario, $contraseña): bool
{
   if (strlen($usuario) < 8) {
      return false;
   }


   if ($contraseña !== strrev($usuario)) {
      return false;
   }
   return true;
}


$nombre = $_POST['nombre'] ?? '';
$contraseña = $_POST['contraseña'] ?? '';



function contarLetra()
{

   $numeroLetras = strlen($_REQUEST['comentario']);
   return $numeroLetras;
}
function numeroPalabras()
{

   $numeroPalabras = str_word_count($_REQUEST['comentario']);
   return $numeroPalabras;
}
function LetraRepetida()
{

   $LetraRepetida = chr(array_search(max(count_chars(strtolower(preg_replace('/[^a-z]/', '', $_REQUEST['comentario'])), 1)), count_chars(strtolower(preg_replace('/[^a-z]/', '', $_REQUEST['comentario'])), 1)));
   return $LetraRepetida;
}
function palabraRepetida()
{

   $palabraRepetida = array_search(max(array_count_values(str_word_count(strtolower($_REQUEST['comentario']), 1))), array_count_values(str_word_count(strtolower($_REQUEST['comentario']), 1)));
   return $palabraRepetida;
}

?>