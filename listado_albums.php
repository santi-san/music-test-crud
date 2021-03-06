<?php
/*session_start();
if (!isset($_SESSION['usuario_logueado'])) {
    header('Location: index.php');
    die;
}*/
$titulo = 'Listado de Albums';

require_once 'init.php';
require_once './clases/DB.php';
require_once './clases/discografica.php';
require_once 'funciones.php';


$link = DB::getConnection();
if(!$link){
    header('Location: ' . NOMBRE_PAGINA_ERROR . '?codigo_error=1');
    die;
}
//-->END
# query para el listado de los albums
$query = "SELECT 
    a.id_album,
    a.nomAlbum,
    a.fechaLanzamiento,
    a.catalogo,
    a.tracklist,
    a.imgAlbum,
    b.nomBanda,
    d.nomDiscografica,
    g.nomGenero,
    f.nomFormato
    FROM albums a
    inner join bandas b
    on a.bandas_id_bandas = b.id_bandas
    inner join discograficas d
    on a.discograficas_id_discografica = d.id_discografica
    inner join generos g
    on a.generos_id_genero = g.id_genero
    inner join formatos f
    on a.formatos_id_formato = f.id_formato";

# Comienza filtro de busqueda
$busqueda = isset($_GET['search']) ? $_GET['search'] : '';


if (isset($_GET['search'])){

    $where = isset($_GET['search']) ?  " WHERE nomAlbum LIKE '%$busqueda%' ORDER BY a.nomAlbum" : '';

    //Y por ultimo concatenarias el query que se escribio anteriormente afuera de estas condiciones con
    //el where que hicimos aqui adentro

    $query .= $where;
    $alertParaUsuario = getHtmlAlert(' Mostrando resultados para: <strong>' . $busqueda . '</strong>', 'alert-success');
} else {
    $ordenar = " ORDER BY a.nomAlbum";
    $query .= $ordenar;
}


//*----------------Query principal----------------*/

$stmt = DB::getStatement($query);
$stmt->execute();
$cantidad_de_filas = $stmt->rowCount();
/*--------------------------END--------------------------*/
include 'header.php';
?>

    <h1>Listado de Albums</h1>

<?php
if($cantidad_de_filas > 0){
    echo $alertParaUsuario ?? '';
    include 'listado_albums_tabla.php';
} else {
    echo getHtmlAlert('No se han encontrado resultados para: <strong>' . $busqueda . '</strong> en la base de datos.  Si desea dar de alta un album <a href="altas_album.php" class="alert-link">haga clic aquí</a>', 'alert-danger');

}
require 'footer.php';
