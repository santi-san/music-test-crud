<?php


require_once 'init.php';
require_once './clases/DB.php';
require_once './clases/genero.php';
require_once 'funciones.php';

$link = DB::getConnection();
if(!$link){
    header('Location: ' . NOMBRE_PAGINA_ERROR . '?codigo_error=1');
    die;
}
//-->END
# query para el listado de los generos
$query = "SELECT id_genero, nomGenero FROM generos";


# Comienza filtro de busqueda
$busqueda = isset($_GET['search']) ? $_GET['search'] : '';


if (isset($_GET['search'])){

        $where = isset($_GET['search']) ?  " WHERE nomGenero LIKE '%$busqueda%' ORDER BY nomGenero" : '';

        //Y por ultimo concatenarias el query que se escribio anteriormente afuera de estas condiciones con
        //el where que hicimos aqui adentro

        $query .= $where;

    $alertParaUsuario = getHtmlAlert(' Mostrando resultados para: <strong>' . $busqueda . '</strong>', 'alert-success');

} else {
    $ordenar = " ORDER BY nomGenero";
    $query .= $ordenar;
}

/*----------------Query principal----------------*/

$stmt = DB::getStatement($query);
$stmt->execute();
/*$stmt = $listarGeneros->getDatos($query);*/
$cantidad_de_filas = $stmt->rowCount();
/*--------------------------END--------------------------*/
include 'header.php';
?>

    <h1>Listado de Generos</h1>

<?php
if($cantidad_de_filas > 0){
    echo $alertParaUsuario ?? '';
    include 'listado_generos_tabla.php';
} else {
    echo getHtmlAlert('No se han encontrado resultados para: <strong>' . $busqueda . '</strong> en la base de datos.  Si desea dar de alta un genero  <a href="altas_generos.php" class="alert-link">haga clic aquí</a>', 'alert-danger');
}
require 'footer.php';
