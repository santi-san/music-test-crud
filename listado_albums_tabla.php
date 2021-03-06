<?php
/** @var array $stmt
 *  @var int $cantidad_de_filas
 */
?>
<!-- Filtrar resultados de albums -->
<form action="" method="get" class="row gy-2" >
        <div class="col-lg-8 col-md-8 col-sm-6 col-12">
            <label class="visually-hidden" for="nomdiscog">Nombre</label>
            <input type="text" class="form-control" name="search" id="nomdiscog" placeholder="Let it be" autofocus>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">BUSCAR</button>
        </div>
</form>

<!-- Tabla listado de albums -->
<div class="table-responsive">
    <table class="table align-middle table-striped table-borderless table-dark mt-5">
    <thead class="table-light">
        <tr>
            <th scope="col">Nombre:</th>
            <th scope="col">Lanzamiento:</th>
            <th scope="col">Catalogo:</th>
            <th scope="col">Cover:</th>
            <th scope="col">Banda:</th>
            <th scope="col">Discografica:</th>
            <th scope="col">Genero:</th>
            <th scope="col">Formato:</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
    while($fila = $stmt->fetch()){
        $fecha_a_formatear = date_create_from_format('Y-m-d H:i:s', $fila['fechaLanzamiento']);
        $fecha_corta = date_format($fecha_a_formatear, 'm-Y');
        $fecha_larga = date_format($fecha_a_formatear, 'd-m-Y H:i:s');
        ?>
        <tr class="text-capitalize">
            <td>
                <a class="link-success text-decoration-none" href="album.php?id=<?= $fila['id_album']?>">
                    <?= $fila['nomAlbum']?>
                </a>
            </td>
            <td class="text-nowrap" title="<?= $fecha_larga ?>"><?= $fecha_corta ?></td>
            <td> <?= $fila['catalogo']?> </td>
            <td> <img src="<?= $fila['imgAlbum']?> " class="img-fluid" style="max-width: 45px;max-height: 45px;" alt="<?= $fila['nomAlbum']?>"> </td>
            <td> <?= $fila['nomBanda']?> </td>
            <td> <?= $fila['nomDiscografica']?> </td>
            <td> <?= $fila['nomGenero']?> </td>
            <td> <?= $fila['nomFormato']?> </td>
            <td>
                <a onclick="return confirm('¿Estás seguro de querer editar el album: <?= $fila['nomAlbum'] ?>?');" href="editar_album.php?id_album=<?= $fila['id_album'] ?>">
                    <i class="fas fa-edit" title="editar"></i>
                </a>

                <a onclick="return confirm('¿Estás seguro de querer eliminar el album: <?= $fila['nomAlbum'] ?>?');" href="eliminar.php?id_album=<?=$fila['id_album']?>">
                    <i class="fas fa-trash-alt" title="eliminar"></i>
                </a>
            </td>
        </tr>
        <?php
    }
    ?>

    </tbody>
    <tfoot class="table-secondary">
        <tr>
            <td colspan="9" class="text-center"> Se encontraron <?= $cantidad_de_filas ?> resultados</td>
        </tr>
    </tfoot>
</table>
</div>