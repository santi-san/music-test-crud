<?php

/*session_start();
if (!isset($_SESSION['usuario_logueado'])) {
    header('Location: index.php');
    die;
}*/
require_once './clases/DB.php';
require_once './clases/album.php';
require_once './clases/discografica.php';
require_once './clases/banda.php';
require_once './clases/nacionalidad.php';
require_once './clases/genero.php';


if (isset($_GET['id_album'])){
    $id_album = $_GET['id_album'];

    $eliminar_album = new Album();
    $eliminar_album->eliminarPorId($id_album);
    header('Location: listado_albums.php');
}
elseif (isset($_GET['id_discografica'])){
    $id = $_GET['id_discografica'];

    $eliminar_discografica = new Discografica();
    $eliminar_discografica->eliminarPorId($id);

    header('Location: listado_discograficas.php');
}
elseif (isset($_GET['id_genero'])){
    $id = $_GET['id_genero'];

    $eliminar_genero = new Genero();
    $eliminar_genero->eliminarPorId($id);

    header('Location: listado_generos.php');
}
elseif (isset($_GET['id_bandas'])){
    $id = $_GET['id_bandas'];

    $eliminar_banda = new Banda();
    $eliminar_banda->eliminarPorId($id);

    header('Location: listado_generos.php');
}
elseif (isset($_GET['id_nacionalidad'])){
    $id = $_GET['id_nacionalidad'];

    $eliminar_nacionalidad = new Nacionalidad();
    $eliminar_nacionalidad->eliminarPorId($id);

    header('Location: listado_nacionalidades.php');
}



