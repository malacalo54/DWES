<?php
session_start();

if (isset($_GET['cliente'])) {

    $_SESSION['cliente'] = $_GET['cliente'];
    $_SESSION['pediddos'] = [];
}

if (!isset($_SESSION['cliente'])) {
    require_once('bienvenida.php');
    exit();
}
if (isset($_POST["accion"])) {

    if ($_POST["accion"] == "Anotar") {
        $cantidad = $_POST['cantidad'];
        $fruta = $_POST['fruta'];
        if ($cantidad > 0) {
            if (isset($_SESSION['pedidos'][$fruta])) {
                $_SESSION['pedidos'][$fruta] += $cantidad;

            } else {
                $_SESSION['pedidos'][$fruta] = $cantidad;
            }
        }
    }
    if ($_POST["accion"] == "Anular") {
        unset($_SESSION['pedidos'][$_POST['fruta']]);
    }
    if ($_POST["accion"] == "Terminar") {
        $compraRealizada = htmlTablaPedidos();
        require_once("despedida.php");
        session_destroy();
        exit;
    }
    $compraRealizada = htmlTablaPedidos();

    function htmlTablaPedidos()
    {
        $msg = "";
        if (count($_SESSION['pedidos']) > 0) {
            $msg .= "Este es tu pedido";
            $msg .= "<table style='border: 1px solid black;'>";
            foreach ($$_SESSION['pedidos'] as $fruta => $cantidad) {
                $msg .= "<tr><td><b>" . $fruta . "</b><td></td><td>" . $cantidad . "</td></tr>";
            }
            $msg .= "</table>";
        }
        return $msg;
    }
}
