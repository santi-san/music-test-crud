<?php
require_once './sql/conexion.php';
//Conectar BD -->START
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if(!$link){
    header('Location: ' . NOMBRE_PAGINA_ERROR . '?codigo_error=1');
    die;
}
mysqli_set_charset($link, DB_CHARSET);
//-->END
# query para el listado de los albums
$rs = mysqli_query($link,"SELECT 
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
    on a.formatos_id_formato = f.id_formato
    ORDER BY id_album DESC LIMIT 6");
mysqli_close($link);
while ($fila = mysqli_fetch_assoc($rs)) {
    ?>
<!--<div class="col-4 col-sm-4 col-md-3 col-lg-2 col-xl-2">-->

    <div class="col-4 col-sm-4 col-md-2">
        <div class="card text-muted ">
            <a href="album.php?id=<?= $fila['id_album']?>">
                    <img class="card-img-top" src="<?= $fila['imgAlbum'] ?>" alt=" <?= $fila['nomBanda'] . ' - ' . $fila['nomAlbum'] ?> ">
                </a>
            <div class="py-2 px-2">
                <p class="mb-0 small ln1 text-center text-truncate">
                    <a href="album.php?id=<?= $fila['id_album']?>" class="link-success text-decoration-none"><strong class="d-block"><?= $fila['nomAlbum'] ?></strong></a>
                    <a href="#" class="text-muted"><?= $fila['nomBanda'] ?></a>
                </p>
            </div>
        </div>
    </div>
<?php }