<?php
require_once './sql/conexion.php';


$id_discog = $_GET['id_discografica'];

$sql = 'DELETE FROM discograficas WHERE id_discografica = ' . $id_discog;

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if (!$link) {
    header('Location: ' . NOMBRE_PAGINA_ERROR . '?codigo_error=1');
    die;
}
mysqli_set_charset($link, DB_CHARSET);

$rs = mysqli_query($link, $sql);
mysqli_close($link);

header('Location: listado_discograficas.php');
