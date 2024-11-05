<?php
include 'foro_vo/app/funciones.php';
?>
<div><br>
    <b> Detalles:</b><br>
    <table>
        <tr>
            <td>Control:<?=ControlInyeccionCodigo()?></td>
            <td>Longitud: </td>
            <td><?= contarLetra() ?></td>
        </tr>
        <tr>
            <td>Nº de palabras: </td>
            <td> <?= numeroPalabras() ?> </td>
        </tr>
        <tr>
            <td>Letra + repetida: </td>
            <td><?= LetraRepetida() ?>
            </td>
        </tr>
        <tr>
            <td>Palabra + repetida:</td>
            <td> <?= palabraRepetida() ?>
            </td>
        </tr>
    </table>
</div>