<?php
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
else{
    header('Location: index.php');
}
require_once './clases/DB.php';
$sql =  "SELECT 
    a.id_album,
    a.nomAlbum,
    a.fechaLanzamiento,
    a.catalogo,
    a.tracklist,
    a.imgAlbum,
    b.id_bandas,
    b.nomBanda,
    d.nomDiscografica,
    g.nomGenero,
    f.nomFormato,
   a.discograficas_id_discografica
    FROM albums a
    inner join bandas b
    on a.bandas_id_bandas = b.id_bandas
    inner join discograficas d
    on a.discograficas_id_discografica = d.id_discografica
    inner join generos g
    on a.generos_id_genero = g.id_genero
    inner join formatos f
    on a.formatos_id_formato = f.id_formato WHERE id_album = $id";
//*----------------Query ----------------*/

$stmt = DB::getStatement($sql);
$stmt->execute();
$cantidad_de_filas = $stmt->rowCount();

$artist = '';
/*--------------------------END--------------------------*/

if($cantidad_de_filas < 1){
    header('Location: index.php');
}
/*mysqli_close($link);*/
$fecha_corta = '';
$fecha_larga = '';
include 'header.php';
?>
<section class="my-5" >
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-8">
            <?php
            while($fila = $stmt->fetch()){
                $fecha_a_formatear = date_create_from_format('Y-m-d H:i:s', $fila['fechaLanzamiento']);
                $fecha_corta = date_format($fecha_a_formatear, 'd-m-Y');
                $fecha_larga = date_format($fecha_a_formatear, 'd-m-Y H:i:s');
                $varString = $fila['tracklist'];
                $newString = str_replace("\n", "cortameaca", $varString);
                $StrinToArray = preg_split("/cortameaca/", $newString);
                $artist = $fila['id_bandas'];
            ?>
            <div class="card p-4">
                    <div class="row g-0">
                        <div id="img-album" class=" col-sm-12 col-md-12 col-lg-2 col-lx-2">
                            <div class="mb-3 mb-lg-0 h-100 cover u-cover u-cover-alb" >
                                <img class="card-img" src="<?=$fila['imgAlbum']?>" alt="jupiter band">
                                <span class="msk"></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="h-100">
                                <div class="d-flex justify-content-between flex-column h-100">
                                    <!--Data-->
                                    <div>
                                        <p class="p-0 m-0 h3 text-capitalize mb-2">
                                            <strong><a href="#" class="text-muted text-decoration-none"><?=$fila['nomBanda']?></a> </strong> -
                                            <?=$fila['nomAlbum']?>
                                        </p>
                                        <p class="p-0 m-0">
                                            <strong>Discografica: </strong>
                                            <a href="discografica.php?id=<?= $fila['discograficas_id_discografica']?>" class="text-reset  text-decoration-none">
                                                <?=$fila['nomDiscografica']?>
                                            </a>
                                        </p>
                                        <p class="p-0 m-0">
                                            <strong>Catalogo: </strong>
                                            <?=$fila['catalogo']?>
                                        </p>
                                        <p class="p-0 m-0">
                                            <span title="<?= $fecha_larga ?>">
                                                <strong>Fecha:</strong>
                                                <?= $fecha_corta ?>
                                            </span>
                                        </p>
                                        <p class="p-0 m-0">
                                            <strong>Genero: </strong>
                                            <?=$fila['nomGenero']?>
                                        </p>
                                        <p class="p-0 m-0">
                                            <strong>Formato: </strong>
                                            <?=$fila['nomFormato']?>
                                        </p>
                                    </div>
                                    <!--Buttons-->
                                    <div>
                                        <div class="btn-group my-2" role="group">
                                            <button type="button" class="btn btn-sm btn-danger" title="Reproducir">
                                                <i class="fas fa-play"></i>
                                                Play
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger" title="Agregar a lista de reproduccion">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <button type="button" title="Compartir album" class="btn btn-sm btn-danger">
                                            <i class="fas fa-share-square"></i>
                                            <span class="d-none d-md-inline">Compartir</span>
                                            <span class="badge bg-white">115</span>
                                        </button>
                                        <button type="button" title="Agregar a descargas" class="btn btn-sm btn-danger">
                                            <i class="fas fa-download"></i>
                                            <span class="d-none d-md-inline">Descargar</span>
                                        </button>
                                        <button type="button" title="Ver comentarios" class="btn btn-sm btn-danger">
                                        <i class="fas fa-comments"></i>
                                        <span class="d-none d-md-inline">Comentarios</span>
                                        <span class="badge bg-white">4</span>
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <h3>Tracklist:</h3>
                        <ol>
                            <?php
                            foreach ($StrinToArray as $array){
                                echo '<li style="list-style: none;">' . $array . '</li>';
                            }
                            ?>
                        </ol>
                    </div>
            </div>
            <?php }?>
        </div>
        <div class="col-lg-4">
            <div class="card p-4">
                <div class="text-center">
        <?php
        /*--------------------------DATA ARTIST--------------------------*/
        $sql2 = "SELECT * FROM bandas WHERE id_bandas = $artist";

        $stmt2 = DB::getStatement($sql2);
        $stmt2->execute();
        /*--------------------------DATA ARTIST--------------------------*/
        while($fila2 = $stmt2->fetch()){
            ?>
            <img alt="<?= $fila2['nomBanda']?>" src="<?= $fila2['imgBanda']?>" class="rounded-circle img-responsive mt-2" width="128" height="128">
            <h1><?= $fila2['nomBanda']?></h1>
            <h4><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle me-2"><title>Integrantes</title><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> <?= $fila2['integrantes']?></h4>
            <?php
        }
        ?>
                </div>
            </div>
    </div>
    </div>
</section>
<?php
include 'footer.php';

