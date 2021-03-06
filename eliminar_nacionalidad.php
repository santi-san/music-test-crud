<?php
require_once './sql/conexion.php';


$id_nacion = $_GET['id_nacionalidad'];

$sql = 'DELETE FROM nacionalidades WHERE id_nacionalidad = ' . $id_nacion;

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if (!$link) {
    header('Location: ' . NOMBRE_PAGINA_ERROR . '?codigo_error=1');
    die;
}
mysqli_set_charset($link, DB_CHARSET);

$rs = mysqli_query($link, $sql);
mysqli_close($link);

header('Location: listado_nacionalidades.php');
